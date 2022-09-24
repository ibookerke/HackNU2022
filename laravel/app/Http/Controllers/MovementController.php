<?php

namespace App\Http\Controllers;

use App\Enums\WealthCategories;
use App\Models\Movement;
use App\Models\User;
use Carbon\Carbon;

class MovementController extends Controller
{
    const ValueX = 'x_value';
    const ValueY = 'y_value';
    const Floor = 'floor';

    const BaseMove = 6;

    public int $xMax;
    public int $xMin;
    public int $yMax;
    public int $yMin;

    public float $floorHeight;
    public int $maxFloor;

    public array $changeDirectionCache;

    public function run()
    {
//        $this->xMax = 100;
//        $this->xMin = 0;
//
//        $this->yMax = 100;
//        $this->yMin = 0;
//
//        $this->maxFloor = 4;
//        $this->floorHeight = 6;
//
//        $this->changeDirectionCache = [];
//        $this->resetChangeCache();
//
//        $users = User::all();
//
//        foreach ($users as $user) {
//            $movements = $this->fillMovements($user);
//            Movement::query()
//                ->insert($movements);
//        }

        return view('welcome');
    }

    public function fillMovements($user): array
    {
        $movements = [];

        //initial position
        $movements[0] = $this->setInitialPosition($user);
        $movements[1] = $movements[0];

        //making first move towards inner part of building
        $firstMove = $this->generateFirstMove($movements[0][self::ValueY], $movements[0][self::ValueX]);

        $movements[1][self::ValueX] = $firstMove[self::ValueX];
        $movements[1][self::ValueY] = $firstMove[self::ValueY];
        $movements[1]['timestamp'] = clone $movements[0]['timestamp'];
        $movements[1]['timestamp']->addSeconds(5);

        //populating movements array
        for ($i = 2; $i < 100; $i++) {
            //copying initial data
            $movements[$i] = $movements[0];

            //populating prev and current points
            $prevPoint = [
                self::ValueX => $movements[$i - 2][self::ValueX],
                self::ValueY => $movements[$i - 2][self::ValueY],
                self::Floor => $movements[$i - 2]['floor_label'],
            ];
            $currentPoint = [
                self::ValueX => $movements[$i - 1][self::ValueX],
                self::ValueY => $movements[$i - 1][self::ValueY],
                self::Floor => $movements[$i - 1]['floor_label'],
            ];

            //getting next location
            $nextLocation = $this->getNextLocation($prevPoint, $currentPoint);

            $movements[$i][self::ValueX] = $nextLocation[self::ValueX];
            $movements[$i][self::ValueY] = $nextLocation[self::ValueY];
            $movements[$i]['floor_label'] = $nextLocation[self::Floor];
            $movements[$i]['altitude'] = $movements[$i]['floor_label'] * $this->floorHeight;
            $movements[$i]['timestamp'] = clone $movements[$i - 1]['timestamp'];
            $movements[$i]['timestamp']->addSeconds(5);
        }

        return $movements;
    }

    public function setInitialPosition($user): array
    {
        return [
            'latitude' => 0,// convert to latitude
            self::ValueX => mt_rand($this->yMin, $this->xMax),
            'longitude' => 0, // random longitude
            self::ValueY => mt_rand($this->yMin, $this->yMax),
            'altitude' => 0, // random alt
            'identifier' => $user->name,
            'floor_label' => mt_rand(1, $this->maxFloor),
            'h_accuracy' => 20,
            'v_accuracy' => 2.5,
            'accuracy_confidence' => 0.6827,
            'activity' => 'walking',
            'timestamp' => now(),
            'user_id' => $user->id
        ];
    }

    public function generateFirstMove($y_value, $x_value): array
    {
        $xPositive = abs($this->xMax - $x_value);
        $xNegative = abs($x_value - $this->yMax);

        $yPositive = abs($this->yMax - $y_value);
        $yNegative = abs($y_value - $this->yMax);

        return [
            self::ValueX => $xPositive >= $xNegative ? $x_value + self::BaseMove : $x_value - self::BaseMove,
            self::ValueY => $yPositive >= $yNegative ? $y_value + self::BaseMove : $y_value - self::BaseMove
        ];
    }

    public function getNextLocation($prevPoint, $currentPoint): array
    {
        $next_location = $this->moveInDirection($prevPoint, $currentPoint);
        $next_location[self::Floor] = $currentPoint[self::Floor];

        if(!$this->validateLocation($next_location)) {
            return $this->changeDirection($prevPoint, $currentPoint);
        }

        if(mt_rand(1, 8) == 1) {
            return $this->changeDirection($prevPoint, $currentPoint);
        }

        if(mt_rand(0, 1) == 1) {
            $next_location[self::Floor] = $currentPoint[self::Floor] + $this->changeFloor($prevPoint, $currentPoint);
        }

        return $next_location;
    }

    public function changeFloor($prevPoint, $currentPoint): int
    {
        if($prevPoint[self::Floor] == $currentPoint[self::Floor] || $prevPoint[self::Floor] < $currentPoint[self::Floor]) {
            if($currentPoint[self::Floor] == $this->maxFloor) {
                return -1;
            }
            return 1;
        }
        else{
            if($currentPoint[self::Floor] == 1) {
                return 1;
            }
            return -1;
        }
    }


    public function changeDirection($prevPoint, $currentPoint): array
    {
        $newX = $currentPoint[self::ValueX];
        $newY = $currentPoint[self::ValueY];

        $suggestedX = $this->rotateDecide($prevPoint, $currentPoint, self::ValueX);
        $suggestedY = $this->rotateDecide($prevPoint, $currentPoint, self::ValueY);

        if($suggestedX > 0) {
            $newX += self::BaseMove;
        }
        else if($suggestedX < 0) {
            $newX -= self::BaseMove;
        }

        if($suggestedY > 0) {
            $newY += self::BaseMove;
        }
        else if($suggestedY < 0) {
            $newY -= self::BaseMove;
        }

        $this->resetChangeCache();
        return [
            self::ValueX => $newX,
            self::ValueY => $newY,
            self::Floor => $currentPoint[self::Floor]
        ];
    }

    public function rotateDecide($prevPoint, $currentPoint, $axis): int
    {
        $direction = 0;

        if (mt_rand(1, 5) == 1) {
            if($this->changeDirectionCache[$axis]['positive'] && $this->changeDirectionCache[$axis]['negative']) {
                $direction = rand(0, 1) ? 1 : -1;
            }
        }
        else{
            if($currentPoint[$axis] >= $prevPoint[$axis]) {
                if($this->changeDirectionCache[$axis]['positive']) {
                    $direction = 1;
                }
                else if($this->changeDirectionCache[$axis]['negative']){
                    $direction = -1;
                }
            }
            else{
                if($this->changeDirectionCache[$axis]['negative']){
                    $direction = -1;
                }
                else if($this->changeDirectionCache[$axis]['positive']) {
                    $direction = 1;
                }
            }
        }

        return $direction;
    }

    public function resetChangeCache(): void
    {
        $this->changeDirectionCache = [
            self::ValueX => [
                'positive' => true,
                'negative' => true,
            ],
            self::ValueY => [
                'positive' => true,
                'negative' => true
            ]
        ];
    }

    public function validateLocation($location): bool
    {
        $result = true;
        if($location[self::ValueX] <= $this->xMin) {
            $result = false;
            $this->changeDirectionCache[self::ValueX]['negative'] = false;
        }
        if($location[self::ValueX] >= $this->xMax) {
            $result = false;
            $this->changeDirectionCache[self::ValueX]['positive'] = false;
        }
        if($location[self::ValueY] <= $this->yMin) {
            $result = false;
            $this->changeDirectionCache[self::ValueY]['negative'] = false;
        }
        if($location[self::ValueY] >= $this->yMax) {
            $result = false;
            $this->changeDirectionCache[self::ValueY]['positive'] = false;
        }
        return $result;
    }

    public function moveInDirection($prevPoint, $currentPoint) : array
    {
        $xDiff = $currentPoint[self::ValueX] - $prevPoint[self::ValueX];
        $yDiff = $currentPoint[self::ValueY] - $prevPoint[self::ValueY];

        return [
            self::ValueX => $currentPoint[self::ValueX] + $xDiff,
            self::ValueY => $currentPoint[self::ValueY] + $yDiff
        ];
    }


    public function fetchHeatMapData()
    {
        $movementsByUser = Movement::query()
            ->select('user_id', 'x_value', 'y_value', 'floor_label', 'timestamp')
            ->orderBy('timestamp')
            // floor filter
//            ->where('floor_label', 1)
            // timestamp filter
//            ->where('timestamp', '>=', Carbon::now())
//            ->where('timestamp', '<=', Carbon::now())
            ->get()
            ->groupBy('user_id');

        $users = User::query()->whereIn('id', $movementsByUser->keys()->toArray())->get();

        $xCoordinates = [0, 10];
        $yCoordinates = [0, 10];
        $usersInSquare = Movement::query()
//            ->with('user')
            ->whereIn('x_value', $xCoordinates)
            ->whereIn('y_value', $yCoordinates)
            // floor filter
//          ->where('floor_label', 1);
            ->get();

//        $byWealthCategories =
//        dd($usersInSquare->);
//        dd($movementsByUser, $users);
        return $movementsByUser;
    }
}

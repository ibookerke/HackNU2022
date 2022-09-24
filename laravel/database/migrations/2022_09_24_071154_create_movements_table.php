<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 12, 7)->comment('degrees');
            $table->decimal('longitude', 12 , 7)->comment('degrees');
            $table->integer('x_value');
            $table->integer('y_value');
            $table->float('altitude')->comment('meters, AGL, height above ground');
            $table->timestamp('timestamp');
            $table->string('identifier');
            $table->string('floor_label')->nullable();
            $table->float('h_accuracy');
            $table->float('v_accuracy');
            $table->double('accuracy_confidence', 5, 4);
            $table->string('activity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
    }
};

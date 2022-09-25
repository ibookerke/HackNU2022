<!-- Button trigger modal -->
<button onclick="heatmap()" id="launch_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: none;">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" style="--bs-modal-width: 1650px!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Building Analytics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-around">
                    <div class="col-lg-3 card">
                        <div class="card-header card_heada text-center">
                            Filters
                        </div>
                        <div class="card-body" style="display: flex; flex-direction: column; justify-content: space-between">
                            <div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">From</span>
                                    <input type="date" class="form-control" aria-label="date from" aria-describedby="basic-addon1" onchange="filterChangeFromDate(event)">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">To &nbsp; &nbsp; </span>
                                    <input type="date" class="form-control" aria-label="date from" aria-describedby="basic-addon1" onchange="filterChangeToData(event)">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Age</span>
                                    <select class="form-select" id="filterAgeInput" onchange="filterAgeChange()">
                                        <option value="">Select age group</option>
                                        <option value="1">12-20</option>
                                        <option value="2">20-40</option>
                                        <option value="3">40+</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Gender</span>
                                    <select class="form-select" id="filterGenderInput" onchange="filterGenderChange()">
                                        <option value="">Select gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Floor</span>
                                    <select class="form-select" id="filterFloorInput" onchange="filterFloorChange()">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btn" onclick="applyFilters()">Apply</button>
                        </div>
                    </div>


                    <div onclick="generateRandomCharts()">
                        <x-heatmap/>
                    </div>

                    <div class="col-lg-4 card">
                        <x-charts />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<style>
    .card_heada{
        font-size: 22px;
    }
</style>


@push('scripts')
    <script defer>
        var filterObject = {
            floor: 1,
            from: null,
            to: null,
            age: null,
            gender: null
        }

        function filterChangeFromDate(e) {
            filterObject.fromm = e.target.value;
        }

        function filterChangeToData(e) {
            filterObject.to = e.target.value
        }

        function filterAgeChange() {
            filterObject.age = document.getElementById('filterAgeInput').value
        }

        function filterGenderChange() {
            filterObject.gender = document.getElementById('filterGenderInput').value
        }

        function filterFloorChange() {
            filterObject.floor = document.getElementById('filterFloorInput').value
        }

        function applyFilters() {
            console.log(filterObject)
            fetchHeatmapData(filterObject.floor, filterObject.age, filterObject.gender, filterObject.fromm, filterObject.to)
        }
    </script>
@endpush

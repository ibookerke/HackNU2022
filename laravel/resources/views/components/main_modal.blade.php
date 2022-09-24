<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
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
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">From</span>
                                <input type="date" class="form-control" aria-label="date from" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">To &nbsp; &nbsp; </span>
                                <input type="date" class="form-control" aria-label="date from" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Age</span>
                                <select class="form-select">
                                    <option value="">12-20</option>
                                    <option value="">20-40</option>
                                    <option value="">40+</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Gender</span>
                                <select class="form-select">
                                    <option value="">Male</option>
                                    <option value="">Female</option>
                                    <option value="">Other</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-primary btn">Apply</button>
                        </div>
                    </div>


                    <div style="width: 300px; height: 300px; background: red; width: 35%!important;">
                        <!-- TODO insert HeatMap -->
                    </div>


                    <div class="col-lg-3 card">
                        <div class="card-header card_heada text-center">
                            Floors
                        </div>
                        <div class="card-body" style="display: flex; flex-direction: column; justify-content: space-between">
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>

                            <button type="button" class="btn btn-primary">Upload floor schema</button>
                        </div>
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

    </script>
@endpush

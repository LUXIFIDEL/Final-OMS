<div class="row">
    <div class="col-md-12">
        <form action="" method="GET">
            <div class="input-group search-area mb-2">
                <input wire:model.debounce.500ms="search" type="text" class="form-control" name="search" value="" placeholder="Search here...">
                <span class="input-group-text"><a><i class="flaticon-381-search-2"></i></a></span>
            </div>
        </form>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
               <h2>Expenses Record List</h2>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_id" class="display" style="min-width: 400px">
                        <thead>
                            <tr>
                                <th>Expenses</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Data Here --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Expenses</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-validation">
            <form action="" method="POST" class="needs-validation" novalidate="">
                @csrf
                <div class="row card">
                    <div class="card-header bg-warning">
                        <h4 class="card-title">Expenses Form</h4>
                    </div>
                    
                    <div class="col-md-12 pt-2">
                        <div class="mb-3 row">
                            <label class="col-lg-12 col-form-label" for="validationCustom01">
                                Expenses For
                            </label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="validationCustom01" name="customer"  value="" placeholder="Enter Expenses For.." required="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-12 col-form-label" for="validationCustom01">
                                Amount
                            </label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="validationCustom01" name="rider"  value="" placeholder="Enter Amount.." required="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="" class="btn btn-dark ">Cancel</a>
                                <button type="submit" class="text-black btn btn-warning">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

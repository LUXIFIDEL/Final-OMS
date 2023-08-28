<div>
    <div class="col-12 mb-4">
        <a href="{{route('admin.customer.index')}}" class="btn btn-md ml-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#d0021b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H6M12 5l-7 7 7 7"/></svg>
        </a>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-validation">
                <form action="" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    <div class="row card">
                        <div class="card-header bg-warning">
                            <h4 class="card-title">Customer Information</h4>
                        </div>
                        
                        <div class="col-md-12 pt-2">
                            <table class="table">
                                <tbody>
                                    <tr>
                                    <th class="text-end w-50" scope="row">Name :</th>
                                    <td>Test Test</td>
                                    </tr>
                                    <tr>
                                    <th class="text-end w-50" scope="row">Address :</th>
                                    <td>Test Test</td>
                                    </tr>
                                    <tr>
                                    <th class="text-end w-50" scope="row">Gender :</th>
                                    <td>Test</td>
                                    </tr>
                                    <tr>
                                    <th class="text-end w-50" scope="row">Date of Birth :</th>
                                    <td>Test</td>
                                    </tr>
                                    <tr>
                                    <th class="text-end w-50" scope="row">Contact Number :</th>
                                    <td>Test</td>
                                    </tr>
                                    <tr>
                                    <th class="text-end w-50" scope="row">Email :</th>
                                    <td>Test</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#all" data-toggle="tab">All</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pen" data-toggle="tab">Pendeng</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pro" data-toggle="tab">In-Processing</a></li>
                        <li class="nav-item"><a class="nav-link" href="#oinfo" data-toggle="tab">Completed</a></li>
                        <li class="nav-item"><a class="nav-link" href="#oinfo" data-toggle="tab">Canceled</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display" style="min-width: 400px">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Rider</th>
                                    <th>Order</th>
                                    <th>Expenses</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Data Here --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Customer</th>
                                    <th>Rider</th>
                                    <th>Order</th>
                                    <th>Expenses</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

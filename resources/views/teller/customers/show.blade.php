@extends('layouts.teller')

@section('title')
Customers Management - Transaction History
@endsection

@push('links')
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row invoice-card-row">

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

                            <ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pen-tab" data-bs-toggle="tab" data-bs-target="#pen" type="button" role="tab" aria-controls="pen" aria-selected="true">Pending</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pro-tab" data-bs-toggle="tab" data-bs-target="#pro" type="button" role="tab" aria-controls="pro" aria-selected="false">In-Processing</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="oinfo-tab" data-bs-toggle="tab" data-bs-target="#oinfo" type="button" role="tab" aria-controls="oinfo" aria-selected="false">Completed</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="oinfo-tab" data-bs-toggle="tab" data-bs-target="#oinfo" type="button" role="tab" aria-controls="oinfo" aria-selected="false">Canceled</button>
                                </li>
                            </ul>
                            
                            </div><!-- /.card-header -->
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="pen" role="tabpanel" aria-labelledby="pen-tab">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example3" class="display" style="min-width: 845px">
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
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pro" role="tabpanel" aria-labelledby="pro-tab">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
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
                                                
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>
@endpush
@extends('layouts.admin')

@section('title')
Transactions Management
@endsection

@push('links')
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@section('content')
<div class="content-body">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-validation">
                    <form action="" method="POST" class="needs-validation" novalidate="">
                        @csrf
                        <div class="row card">
                            <div class="card-header">
                                <h4 class="card-title">Transactions Form</h4>
                            </div>
                           
                            <div class="col-md-12 pt-2">
                                <div class="mb-3 row">
                                    <label class="col-lg-12 col-form-label" for="validationCustom01">
                                        Select Customer
                                    </label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" id="validationCustom01" name="customer"  value="" placeholder="Enter Select Customer.." required="">
                                        <div class="invalid-feedback">
                                            Please Select Customer
                                        </div>
                                        @error('customer')
                                            <small class="text-danger" role="alert">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-12 col-form-label" for="validationCustom01">
                                        Select Rider
                                    </label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" id="validationCustom01" name="rider"  value="" placeholder="Enter Select Rider.." required="">
                                        <div class="invalid-feedback">
                                            Please Select Rider
                                        </div>
                                        @error('rider')
                                            <small class="text-danger" role="alert">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="mb-3 row">
                                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                                            Order
                                        </label>
                                        <div class="col-lg-12">
                                            <textarea type="text" class="form-control" id="validationCustom01" name="section_name"  value="" placeholder="Enter a Order.." required="" rows="5"></textarea>
                                            <div class="invalid-feedback">
                                                Please enter Order.
                                            </div>
                                            @error('order')
                                                <small class="text-danger" role="alert">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="mb-3 row">
                                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                                            Total Order
                                        </label>
                                        <div class="col-lg-12">
                                            <input type="number" class="form-control" id="validationCustom01" name="section_name"  value="" placeholder="Enter a amount.." required="">
                                            <div class="invalid-feedback">
                                                Please enter amount.
                                            </div>
                                            @error('expenses')
                                                <small class="text-danger" role="alert">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="mb-3 row">
                                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                                            Delivery Fee
                                        </label>
                                        <div class="col-lg-12">
                                            <input type="number" class="form-control" id="validationCustom01" name="section_name"  value="" placeholder="Enter a amount.." required="">
                                            <div class="invalid-feedback">
                                                Please enter amount.
                                            </div>
                                            @error('expenses')
                                                <small class="text-danger" role="alert">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="" class="btn btn-dark ">Cancel</a>
                                        <button type="submit" class="btn btn-warning">Save</button>
                                    </div>
                                </div>
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
                    <div class="col-md-12 p-2">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Warning!</strong> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
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
</div>

@endsection

@push('script')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>

@endpush
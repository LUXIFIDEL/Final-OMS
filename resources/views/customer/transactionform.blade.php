@extends('layouts.customer')

@section('title')
Transactions Form
@endsection

@push('links')
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-6 mx-auto">
                <div class="form-validation">
                    <form action="{{route('client.transaction.store')}}" method="POST" class="needs-validation" novalidate="">
                        @csrf
                        <div class="row card">
                            <div class="card-header">
                                <h4 class="card-title">Create Transactions</h4>
                            </div>
                            
                            <div class="col-md-12 pt-2">

                                <div class="mb-3 row">
                                    <div class="mb-3 row">
                                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                                            Your Name
                                        </label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control border-0 input-sm" value="{{auth()->user()->name}}" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                                            Your Address
                                        </label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control border-0 input-sm" value="{{$get_customer->address ?? 'N/A'}}" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                                            Your Order
                                        </label>
                                        <div class="col-lg-12">
                                            <textarea type="text" class="form-control" id="validationCustom01" name="order_msg"  value="" placeholder="Enter a Order.." required="" rows="5"></textarea>
                                            <div class="invalid-feedback">
                                                Please enter Order.
                                            </div>
                                            @error('order_msg')
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
                                        <button type="submit" class="text-black btn btn-warning">Placed Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        
    </div>
</div>

@endsection

@push('script')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
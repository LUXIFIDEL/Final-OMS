@extends('layouts.admin')

@section('title')
Transactions Management
@endsection

@push('links')
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="content-body">
    <div class="container-fluid">
    
    <div class="row">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="form-validation">
                <form action="{{route('admin.transaction.store')}}" method="POST" class="needs-validation" novalidate="">
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
                                    <select class="js-single form-control" name="user_id">
                                    <option selected disabled></option>
                                    @foreach($get_customer as $dt_custom)
                                    <option value="{{ $dt_custom->user->id }}">{{$dt_custom->user->name}}</option>
                                    @endforeach
                                    </select>
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
                                    Assign Rider 
                                </label>
                                <div class="col-lg-12">
                                <select class="js-single form-control" name="rider">
                                    <option selected disabled>Selete Rider</option>
                                    @foreach($get_rider->where('is_not_available',false) as $data_rider)
                                        @php
                                            $countForRider = $get_count_rider
                                                ->where('rider_id', $data_rider->user->id)
                                                ->count();
                                        @endphp
                                        @if($countForRider >= 5)
                                        <option disabled>{{ $data_rider->user->name }} (Not Available)</option>
                                        @else
                                        <option value="{{ $data_rider->user->id }}">{{ $data_rider->user->name }} (Total Assigned: {{ $countForRider }})</option>
                                        @endif
                                    @endforeach
                                </select>
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
                                        <textarea type="text" class="form-control" id="validationCustom01" name="order_msg"  value="{{old('order_msg')}}" placeholder="Enter a Order.." required="" rows="5"></textarea>
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
                                        Order Amount
                                    </label>
                                    <div class="col-lg-12">
                                        <input type="number" class="form-control rounded-pill" id="validationCustom01" name="amount"  value="{{old('amount')}}" placeholder="Enter a amount..">
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
                                        <input type="number" class="form-control rounded-pill" id="validationCustom01" name="delivery_fee"  value="{{old('delivery_fee')}}" placeholder="Enter a amount.." required="">
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
                                    <a href="{{route('admin.transaction.index')}}" class="btn btn-dark ">Cancel</a>
                                    <button type="submit" class="text-black btn btn-warning">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
       
        @include('admin.transactions.inc_table')

    </div>
      

    </div>
</div>

<!-- Modal -->
@include('admin.transactions.inc_modal')

@endsection

@push('script')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-single').select2();
    });
     $(document).ready(function() {
        $('.js-single').select2();
    });
    $('#viewModal').on('show.bs.modal', function (e) {
        var opener=e.relatedTarget;
        var id=$(opener).attr('id');
        var trans_no=$(opener).attr('trans_no');
        var customer=$(opener).attr('customer');
        var address=$(opener).attr('address');
        var order=$(opener).attr('order');
        var prin_amount=$(opener).attr('prin_amount');
        var delivery_fee=$(opener).attr('delivery_fee');

        $('#view_frm').find('[name="id"]').val(id);
        $('#view_frm').find('[name="trans_no"]').val(trans_no);
        $('#view_frm').find('[name="customer"]').val(customer);
        $('#view_frm').find('[name="address"]').val(address);
        $('#view_frm').find('[name="order"]').val(order);
        document.getElementById('prin_amount').innerText = "Order amount: "+prin_amount;
        document.getElementById('delivery_fee').innerText = "Delivery Fee: "+delivery_fee;
    });
    $('#feedModal').on('show.bs.modal', function (e) {
        var opener=e.relatedTarget;
        var id=$(opener).attr('id');
        var feedback_msg=$(opener).attr('feedback_msg');
        $('#feed_frm').find('[name="id"]').val(id);
        $('#feed_frm').find('[name="feedback_msg"]').val(feedback_msg);
    });
    $('#viewcaModal').on('show.bs.modal', function (e) {
        var opener=e.relatedTarget;
        var id=$(opener).attr('id');
        var trans_no=$(opener).attr('trans_no');
        var customer=$(opener).attr('customer');
        var order=$(opener).attr('order');
        var address=$(opener).attr('address');
        var reason=$(opener).attr('reason');
        $('#viewca_frm').find('[name="id"]').val(id);
        $('#viewca_frm').find('[name="trans_no"]').val(trans_no);
        $('#viewca_frm').find('[name="order"]').val(order);
        $('#viewca_frm').find('[name="address"]').val(address);
        $('#viewca_frm').find('[name="customer"]').val(customer);
        $('#viewca_frm').find('[name="reason"]').val(reason);
    });
    $('#caModal').on('show.bs.modal', function (e) {
        var opener=e.relatedTarget;
        var id=$(opener).attr('id');
        $('#ca_frm').find('[name="id"]').val(id);
    });
    $('#coModal').on('show.bs.modal', function (e) {
        var opener=e.relatedTarget;
        var id=$(opener).attr('id');
        $('#co_frm').find('[name="id"]').val(id);
    });
</script>
@endpush
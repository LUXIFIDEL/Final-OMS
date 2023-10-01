@extends('layouts.rider')

@section('title')
Customer Transaction
@endsection

@push('links')
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            
            @include('riders.inc_table_status')

        </div>
    </div>
</div>

<!-- Modal -->
@include('riders.inc_modal')

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
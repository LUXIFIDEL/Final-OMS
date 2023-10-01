@extends('layouts.customer')

@section('title')
Order Status Management
@endsection

@push('links')
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@section('content')
<div class="content-body">
    <div class="container-fluid">
    
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                    <h4 class="card-title p-3">Notifications Transaction</h4>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                    </svg>
                    <div class="card-body">

                        <div class="alert alert-primary d-flex align-items-center alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                            <div>
                                An example alert with an icon
                            </div>
                        </div>

                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                An example success alert with an icon
                            </div>
                        </div>

                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                An example warning alert with an icon
                            </div>
                        </div>

                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                An example danger alert with an icon
                            </div>
                        </div>
                       
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <a class="btn btn-warning btn-sm col-md-2">Mark all as read</a>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
     $(document).ready(function() {
        $('.js-single').select2();
    });
    $('#viewModal').on('show.bs.modal', function (e) {
        var opener=e.relatedTarget;
        var id=$(opener).attr('id');
        var trans_no=$(opener).attr('trans_no');
        var order=$(opener).attr('order');
        var prin_amount=$(opener).attr('prin_amount');
        var delivery_fee=$(opener).attr('delivery_fee');
        $('#view_frm').find('[name="id"]').val(id);
        $('#view_frm').find('[name="trans_no"]').val(trans_no);
        $('#view_frm').find('[name="order"]').val(order);
        document.getElementById('prin_amount').innerText = "Order amount: "+prin_amount;
        document.getElementById('delivery_fee').innerText = "Delivery Fee: "+delivery_fee;
    });
    $('#viewcaModal').on('show.bs.modal', function (e) {
        var opener=e.relatedTarget;
        var id=$(opener).attr('id');
        var trans_no=$(opener).attr('trans_no');
        var order=$(opener).attr('order');
        var reason=$(opener).attr('reason');
        $('#viewca_frm').find('[name="id"]').val(id);
        $('#viewca_frm').find('[name="trans_no"]').val(trans_no);
        $('#viewca_frm').find('[name="order"]').val(order);
        $('#viewca_frm').find('[name="reason"]').val(reason);
    });
    $('#caModal').on('show.bs.modal', function (e) {
        var opener=e.relatedTarget;
        var id=$(opener).attr('id');
        $('#ca_frm').find('[name="id"]').val(id);
    });
    $('#feedModal').on('show.bs.modal', function (e) {
        var opener=e.relatedTarget;
        var id=$(opener).attr('id');
        $('#feed_frm').find('[name="id"]').val(id);
    });
</script>
@endpush
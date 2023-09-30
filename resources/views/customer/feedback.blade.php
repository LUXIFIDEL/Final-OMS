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
                        Your Feedback List
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Trans No.</th>
                                        <th>Total Amount</th>
                                        <th>Rider</th>
                                        <th>Status</th>
                                        <th>Your Feedback</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($get_feedback->where('status','Completed') as $data)
                                    @if($data->feedback_msg != null)
                                    <tr>
                                        <td>{{$data->trans_no}}</td>
                                        <td>{{$data->prin_amount + $data->delivery_fee}}</td>
                                        @forelse($get_rider->where('id',$data->rider_id)->take(1) as $data_user_id)
                                        <td>{{$data_user_id->user->name}}</td>
                                        @empty
                                        <td>N/A</td>
                                        @endforelse
                                        <td><span class="text-success">{{$data->status}}</span></td>
                                        <td><textarea class="form-control" cols="30" rows="5">{{$data->feedback_msg}}</textarea></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                     
                </div>
            </div>


        </div>
        
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="viewcaModal" tabindex="-1" aria-labelledby="viewcaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="form-validation">
            <form id="viewca_frm">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewcaModalLabel">View Order</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Your Transaction Number:
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="trans_no" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Your Order:
                        </label>
                        <div class="col-lg-12">
                            <textarea name="order" class="form-control"  id="validationCustom01" cols="30" rows="5" readonly></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Your Reason to Cancelled Order:
                        </label>
                        <div class="col-lg-12">
                            <textarea name="reason" class="form-control"  id="validationCustom01" cols="30" rows="5" readonly></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>  
            </form>
        </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="form-validation">
            <form id="view_frm">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Order</h5>
                    <h6 id="prin_amount"></h6>
                    <h6 id="delivery_fee"></h6>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Your Transaction Number:
                        </label>
                        <div class="col-lg-12">
                            <input type="text" name="trans_no" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Your Order:
                        </label>
                        <div class="col-lg-12">
                            <textarea name="order" class="form-control"  id="validationCustom01" cols="30" rows="5" readonly></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>  
            </form>
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
        document.getElementById('delivery_fee').innerText = "Order Delivery: "+delivery_fee;
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
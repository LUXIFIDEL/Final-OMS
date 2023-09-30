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
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">

                    <ul class="nav nav-pills gap-2 nav-fill pt-2 mx-auto"  role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pen-tab" data-bs-toggle="tab" data-bs-target="#pen" type="button" role="tab" aria-controls="pen" aria-selected="true"><i class="fa fa-clock" aria-hidden="true"></i> Pending</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pro-tab" data-bs-toggle="tab" data-bs-target="#pro" type="button" role="tab" aria-controls="pro" aria-selected="false"><i class="fa fa-spinner" aria-hidden="true"></i>  In-Processing</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="oinfo-tab" data-bs-toggle="tab" data-bs-target="#oinfo" type="button" role="tab" aria-controls="oinfo" aria-selected="false"><i class="fa fa-check-circle" aria-hidden="true"></i> Completed</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="can-tab" data-bs-toggle="tab" data-bs-target="#can" type="button" role="tab" aria-controls="can" aria-selected="false"><i class="fa fa-ban" aria-hidden="true"></i> Canceled</button>
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
                                            <th>Trans No.</th>
                                            <th>Rider</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($get_transaction->where('status','Pending') as $data)
                                            <tr>
                                            <td>{{$data->trans_no}}</td>
                                            <td>{{$data->rider_id ?? 'Waiting for assign rider'}}</td>
                                            <td><span class="text-danger">{{$data->status}}</span></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#viewModal"
                                                        id="{{$data->id}}"
                                                        trans_no="{{$data->trans_no}}"
                                                        order="{{$data->order}}"
                                                        prin_amount="{{$data->prin_amount ?? '0'}}"
                                                        delivery_fee="{{$data->delivery_fee ?? '0'}}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-danger shadow btn-xs sharp me-1" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#caModal"
                                                        id="{{$data->id}}">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                </div>		
                                            </td>
                                            </tr>
                                            @endforeach
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
                                            <th>Trans No.</th>
                                            <th>Total Amount</th>
                                            <th>Rider</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($get_transaction->where('status','Inprocess') as $data)
                                            <tr>
                                                <td>{{$data->trans_no}}</td>
                                                <td>{{$data->prin_amount + $data->delivery_fee}}</td>
                                                @foreach($get_rider->where('id',$data->rider_id)->take(1) as $data_user_id)
                                                <td>{{$data_user_id->user->name}}</td>
                                                @endforeach
                                                <td><span class="text-info">{{$data->status}}</span></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#viewModal"
                                                            id="{{$data->id}}"
                                                            trans_no="{{$data->trans_no}}"
                                                            order="{{$data->order}}"
                                                            prin_amount="{{$data->prin_amount ?? '0'}}"
                                                            delivery_fee="{{$data->delivery_fee ?? '0'}}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>		
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="oinfo" role="tabpanel" aria-labelledby="oinfo-tab">
                            <div class="card-body">
                                <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Trans No.</th>
                                            <th>Total Amount</th>
                                            <th>Rider</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($get_transaction->where('status','Completed') as $data)
                                            <tr>
                                                <td>{{$data->trans_no}}</td>
                                                <td>{{$data->prin_amount + $data->delivery_fee}}</td>
                                                @foreach($get_rider->where('id',$data->rider_id)->take(1) as $data_user_id)
                                                <td>{{$data_user_id->user->name}}</td>
                                                @endforeach
                                                <td><span class="text-success">{{$data->status}}</span></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#viewModal"
                                                            id="{{$data->id}}"
                                                            trans_no="{{$data->trans_no}}"
                                                            order="{{$data->order}}"
                                                            prin_amount="{{$data->prin_amount ?? '0'}}"
                                                            delivery_fee="{{$data->delivery_fee ?? '0'}}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        
                                                        @if($data->feedback_msg == null)
                                                        <a class="btn btn-warning shadow btn-xs sharp me-1" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#feedModal"
                                                            id="{{$data->id}}">
                                                            <i class="fas fa-comments"></i>
                                                        </a>
                                                        @endif
                                                    </div>		
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="can" role="tabpanel" aria-labelledby="can-tab">
                            <div class="card-body">
                                <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Trans No.</th>
                                            <th>Rider</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($get_transaction->where('status','Cancelled') as $data)
                                        <tr>
                                        <td>{{$data->trans_no}}</td>
                                        <td>{{'Not Available'}}</td>
                                        <td><span class="text-dark">{{$data->status}}</span></td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#viewcaModal"
                                                    id="{{$data->id}}"
                                                    trans_no="{{$data->trans_no}}"
                                                    reason="{{$data->reason}}"
                                                    order="{{$data->order}}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>		
                                        </td>
                                        </tr>
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
        
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="feedModal" tabindex="-1" aria-labelledby="feedModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="form-validation">
            <form action="{{route('client.transaction.update_feedback')}}" 
                    method="post" 
                    class="needs-validation" 
                    novalidate="" 
                    enctype="multipart/form-data"
                    id="feed_frm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" 
                            name="id">

                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" 
                                for="validationCustom01">
                            Feedback
                        </label>
                        <div class="col-lg-12">
                            <textarea name="feedback_msg" 
                                        class="form-control" 
                                        id="validationCustom01"
                                        cols="30" 
                                        rows="5"></textarea>
                            @error('feedback_msg')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>  
            </form>
        </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="caModal" tabindex="-1" aria-labelledby="caModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="form-validation">
            <form action="{{route('client.transaction.update_status')}}" 
                    method="post" 
                    class="needs-validation" 
                    novalidate="" 
                    enctype="multipart/form-data"
                    id="ca_frm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="caModalLabel">Cancelling..?</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" 
                            name="id">

                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" 
                                for="validationCustom01">
                            Reason for Cancelling
                        </label>
                        <div class="col-lg-12">
                            <textarea name="reason" 
                                        class="form-control" 
                                        id="validationCustom01"
                                        cols="30" 
                                        rows="5"></textarea>
                            @error('reason')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>  
            </form>
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
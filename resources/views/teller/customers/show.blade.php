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
                    <a onclick="window.history.go(-1); return false;" class="btn btn-md ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#d0021b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H6M12 5l-7 7 7 7"/></svg>
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-validation">
                            <div class="row card">
                                <div class="card-header bg-warning">
                                    <h4 class="card-title">Customer Information</h4>
                                </div>
                                
                                <div class="col-md-12 pt-2">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                            <th class="text-end w-50" scope="row">Name :</th>
                                            <td>{{$get_user->name}}</td>
                                            </tr>
                                            <tr>
                                            <th class="text-end w-50" scope="row">Address :</th>
                                            <td>{{$get_user->customer->address}}</td>
                                            </tr>
                                            <tr>
                                            <th class="text-end w-50" scope="row">Gender :</th>
                                            <td>{{$get_user->customer->gender}}</td>
                                            </tr>
                                            <tr>
                                            <th class="text-end w-50" scope="row">Date of Birth :</th>
                                            <td>{{\Carbon\Carbon::parse($get_user->customer->birthdate)->format('M d, Y')}}</td>
                                            </tr>
                                            <tr>
                                            <th class="text-end w-50" scope="row">Contact Number :</th>
                                            <td>{{$get_user->customer->cellphone_number}}</td>
                                            </tr>
                                            <tr>
                                            <th class="text-end w-50" scope="row">Email Address:</th>
                                            <td>{{$get_user->email}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                                    <button class="nav-link" id="can-tab" data-bs-toggle="tab" data-bs-target="#can" type="button" role="tab" aria-controls="can" aria-selected="false">Canceled</button>
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
                                                    @foreach($get_transaction->where('status','Pending')->where('user_id', $get_user->id) as $data)
                                                    <tr>
                                                        <td>{{$data->trans_no}}</td>
                                                        <td>Not Assigned</td>
                                                        <td><span class="text-danger">Pending</span></td>
                                                        <td>
                                                        <div class="d-flex">
                                                            <a href="{{route('teller.transaction.edit', $data->id)}}" class="btn btn-success shadow btn-xs sharp me-1">
                                                                <i class="fas fa-thumbs-up"></i>
                                                            </a>

                                                            <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#viewModal"
                                                                id="{{$data->id}}"
                                                                trans_no="{{$data->trans_no}}"
                                                                customer="{{$get_user->name}}"
                                                                order="{{$data->order}}">
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
                                                    <th>Rider</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($get_transaction->where('status','Inprocess')->where('user_id', $get_user->id) as $data)
                                                    <tr>
                                                    <td>{{$data->trans_no}}</td>
                                                    @forelse($get_rider->where('id',$data->rider_id)->take(1) as $data_user_id)
                                                    <td>{{$data_user_id->user->name}}</td>
                                                    @empty
                                                    <td>N/A</td>
                                                    @endforelse
                                                    <td>{{$data->prin_amount + $data->delivery_fee}}</td>
                                                    <td><span class="text-primary">Inprocess</span></td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a class="btn btn-success shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#coModal"
                                                                id="{{$data->id}}">
                                                                <i class="fas fa-check"></i>
                                                            </a>

                                                            <a href="{{route('teller.transaction.edit', $data->id)}}" 
                                                                class="btn btn-secondary shadow btn-xs sharp me-1">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>

                                                            <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#viewModal"
                                                                id="{{$data->id}}"
                                                                trans_no="{{$data->trans_no}}"
                                                                customer="{{$get_user->name}}"
                                                                @foreach($get_customer->where('user_id',$data->user_id)->take(1) as $data_customer)
                                                                address="{{$data_customer->address ?? 'N/A'}}"
                                                                @endforeach
                                                                prin_amount="{{$data->prin_amount ?? '0'}}"
                                                                delivery_fee="{{$data->delivery_fee ?? '0'}}"
                                                                order="{{$data->order}}">
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

                                <div class="tab-pane fade" id="oinfo" role="tabpanel" aria-labelledby="oinfo-tab">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                <th>Trans No.</th>
                                                <th>Rider</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($get_transaction->where('user_id', $get_user->id)->where('status','Completed') as $data)
                                                    <tr>
                                                    <td>{{$data->trans_no}}</td>
                                                    @forelse($get_rider->where('id',$data->rider_id)->take(1) as $data_user_id)
                                                    <td>{{$data_user_id->user->name}}</td>
                                                    @empty
                                                    <td>N/A</td>
                                                    @endforelse
                                                    <td>{{$data->prin_amount + $data->delivery_fee}}</td>
                                                    <td><span class="text-success">Completed</span></td>
                                                    <td>
                                                        <div class="d-flex">
                                                            
                                                            <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#viewModal"
                                                                id="{{$data->id}}"
                                                                trans_no="{{$data->trans_no}}"
                                                                customer="{{$get_user->name}}"
                                                                @foreach($get_customer->where('user_id',$data->user_id)->take(1) as $data_customer)
                                                                address="{{$data_customer->address ?? 'N/A'}}"
                                                                @endforeach
                                                                prin_amount="{{$data->prin_amount ?? '0'}}"
                                                                delivery_fee="{{$data->delivery_fee ?? '0'}}"
                                                                order="{{$data->order}}">
                                                                <i class="fas fa-eye"></i>
                                                            </a>

                                                            @if($data->feedback_msg != null)
                                                            <a class="btn btn-warning shadow btn-xs sharp me-1" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#feedModal"
                                                                id="{{$data->id}}"
                                                                feedback_msg="{{$data->feedback_msg}}">
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
                                                <th>Total Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($get_transaction->where('status','Cancelled') as $data)
                                                <tr>
                                                    <td>{{$data->trans_no}}</td>
                                                    @forelse($get_rider->where('id',$data->rider_id)->take(1) as $data_user_id)
                                                    <td>{{$data_user_id->user->name}}</td>
                                                    @empty
                                                    <td>N/A</td>
                                                    @endforelse
                                                    <td><span class="text-secondary">Cancelled</span></td>
                                                    <td>
                                                    <div class="d-flex">
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#viewcaModal"
                                                            id="{{$data->id}}"
                                                            trans_no="{{$data->trans_no}}"
                                                            customer="{{$get_user->name}}"
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
    </div>
</div>
<!-- Modal -->
@include('teller.transactions.inc_modal')

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
        document.getElementById('delivery_fee').innerText = "Order Delivery: "+delivery_fee;
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
    $('#feedModal').on('show.bs.modal', function (e) {
        var opener=e.relatedTarget;
        var id=$(opener).attr('id');
        var feedback_msg=$(opener).attr('feedback_msg');
        $('#feed_frm').find('[name="feedback_msg"]').val(feedback_msg);
        $('#feed_frm').find('[name="id"]').val(id);
    });
</script>
@endpush
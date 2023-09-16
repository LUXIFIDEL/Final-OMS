@extends('layouts.customer')

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
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="col-md-8">
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
                                                <a href="" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                                                <a href="" class="btn btn-success shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fas fa-times-circle"></i></a>
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
                                        <th>Customer</th>
                                        <th>Rider</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>2023-0003</td>
                                      <td>Customer 2</td>
                                      <td>Rider 3</td>
                                      <td><span class="text-primary">In-process</span></td>
                                      <td>
                                        <div class="d-flex">
                                            <a href="" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                                            <a href="" class="btn btn-success shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fas fa-trash"></i></a>
                                        </div>		
                                      </td>
                                    </tr>
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
                                        <th>Customer</th>
                                        <th>Rider</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>2023-0003</td>
                                      <td>Customer 2</td>
                                      <td>Rider 3</td>
                                      <td><span class="text-success">Completed</span></td>
                                      <td>
                                        <div class="d-flex">
                                            <a href="" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                                            <a href="" class="btn btn-success shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fas fa-trash"></i></a>
                                        </div>		
                                      </td>
                                    </tr>
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
                                        <th>Customer</th>
                                        <th>Rider</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>2023-0004</td>
                                      <td>Customer 4</td>
                                      <td>Rider 4</td>
                                      <td><span class="text-secondary">Cancelled</span></td>
                                      <td>
                                        <div class="d-flex">
                                            <a href="" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                                            <a href="" class="btn btn-success shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fas fa-trash"></i></a>
                                        </div>		
                                      </td>
                                    </tr>
                                  </tbody>
                              </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-md-4">
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
                                        @error('order')
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
<script>
  $(document).ready(function() {
    $('.js-single').select2();
});
</script>
@endpush
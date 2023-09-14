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
                                    <select class="js-single form-control" name="customer">
                                      <option selected disabled></option>
                                      <option value="1">Customer 1</option>
                                      <option value="2">Customer 2</option>
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
                                    <option selected disabled></option>
                                    <option value="1">Rider 1</option>
                                    <option value="2">Rider 2</option>
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
                                        <input type="number" class="form-control rounded-pill" id="validationCustom01" name="section_name"  value="" placeholder="Enter a amount.." required="">
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
                                        <input type="number" class="form-control rounded-pill" id="validationCustom01" name="section_name"  value="" placeholder="Enter a amount.." required="">
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
                                    <button type="submit" class="text-black btn btn-warning">Save</button>
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
                                          <th>Customer</th>
                                          <th>Rider</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                          <td>2023-0001</td>
                                          <td>Customer 1</td>
                                          <td>Rider 1</td>
                                          <td><span class="text-danger">Pending</span></td>
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
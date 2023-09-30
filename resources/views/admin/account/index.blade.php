@extends('layouts.admin')

@section('title')
Users Management
@endsection

@push('links')
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row invoice-card-row">
           
            <div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-warning">
                            <h3 class="card-title">User Management</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Date Created</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($get_user as $data)
                                            <tr>
                                                <td>{{$data->created_at}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->email}}</td>
                                                <td class="text-capitalize">{{$data->role}}</td>
                                                <td><a class="text-success" href="">Activated</a></td>
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
@endsection

@push('script')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>
@endpush
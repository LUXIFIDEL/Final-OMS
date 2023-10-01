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
                                                @if($data->is_deactivated == '1')
                                                <td><a class="text-danger" data-bs-toggle="modal" data-bs-target="#caModal{{$data->id}}">Deactivated</a></td>
                                                @else
                                                <td><a class="text-success" data-bs-toggle="modal" data-bs-target="#caModal{{$data->id}}">Activated</a></td>
                                                @endif
                                            </tr>
                                            <div class="modal fade" id="caModal{{$data->id}}" tabindex="-1" aria-labelledby="caModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <div class="flex">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="#d0021b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>    
                                                            </div>
                                                            <br>   
                                                            Are you sure you want to change the status of this data?
                                                        </div>
                                                        <form action="{{route('admin.account.changeUserStatus', $data->id)}}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Yes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
@extends('layouts.teller')


@section('title')
Riders Management
@endsection

@push('links')
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row invoice-card-row">
           <livewire:riders.riders />
        </div>
    </div>
</div>
@endsection


@push('script')
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
@endpush
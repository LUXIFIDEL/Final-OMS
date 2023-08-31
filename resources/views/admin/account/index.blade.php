@extends('layouts.admin')

@section('title')
Users Management
@endsection

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row invoice-card-row">
           <livewire:account.usermanagement />
        </div>
    </div>
</div>
@endsection

@push('script')

@endpush
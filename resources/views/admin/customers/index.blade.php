@extends('layouts.admin')

@section('title')
Customers Management
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row invoice-card-row">
            <livewire:admin.customers />
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush
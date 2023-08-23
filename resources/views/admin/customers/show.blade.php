@extends('layouts.admin')

@section('title')
Customers Management - Transaction History
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row invoice-card-row">
            <livewire:admin.show-order-history />
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush
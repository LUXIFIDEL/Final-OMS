@extends('layouts.teller')

@section('title')
Customers Management
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row invoice-card-row">
            <livewire:customers.customers />
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush
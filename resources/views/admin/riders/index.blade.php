@extends('layouts.admin')

@section('title')
Riders Management
@endsection

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

@endpush
@extends('layouts.admin')

@section('title')
Sales Management
@endsection

@push('links')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Summary Sales Report</h4>
                        <div class="col-6">
                            <form method="GET">
                                <div class="row">
                                    <label class="col-md-5 mt-2 col-form-label text-md-end align-self-center">Filtered by: </label>
                                    <div class="col-md-4 mt-2">
                                        <select name="filter" class="form-control">
                                           <option value="today">Today</option>
                                           <option @if(request('filter')=='yesterday') selected @endif value="yesterday">Yesterday</option>
                                           <option @if(request('filter')=='weekly') selected @endif value="weekly">Last 7 Days</option>
                                           <option @if(request('filter')=='last_30_days') selected @endif value="last_30_days">Last 30 Days</option>
                                           <option @if(request('filter')=='this_mo') selected @endif value="this_mo">This Month</option>
                                           <option @if(request('filter')=='last_mo') selected @endif value="last_mo">Last Month</option>
                                           <option @if(request('filter')=='annual') selected @endif value="annual">Annual</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <button class="btn btn-sm btn-dark align-self-center"><i class="fa fa-filter" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </form>
						</div>	
                    </div>
                    <div class="card-body">
                    {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
{!! $chart->script() !!}
@endpush
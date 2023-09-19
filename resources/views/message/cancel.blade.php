@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:90px">
    <div class="row  mt-5">
    <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-8 p-5 mx-auto">
                        <div class="text-center">
                            <h1 class="text-warning text-uppercase"><b>Order Cancelled!</b></h1>
                            <h4 class="text-warning text-uppercase"><b>Your transaction no: {{$transno}} has been cancelled.</b></h4>
                            <p>Thank you using our system! You may continue odering request.</p>
                            <a href="{{route('client.home')}}" class="p-3 btn mt-2 ml-2 btn-sm text-white" style="background-color:#5f9ea0">Make Transaction Again</a>
                            <a href="/" class="btn mt-2 btn-sm text-white p-3" style="background-color:#5f9ea0">Back to your profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection
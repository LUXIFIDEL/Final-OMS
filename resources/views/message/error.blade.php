@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:90px">
    <div class="row  mt-5">
    <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-8 p-5 mx-auto">
                        <div class="text-center">
                            <h1 class="text-danger text-uppercase"><b>Failed to order!</b></h1>
                            <h4 class="text-danger text-uppercase"><b>your pending transaction no: {{$transno}}</b></h4>
                            <p>Please wait until approved your transaction and it will begin processing it soon.<br> Please contact the teller to process and assign rider in your requested order. Thank you!</p>
                            <a href="{{route('client.transaction.index')}}" class="p-3 btn mt-2 ml-2 btn-sm text-white" style="background-color:#5f9ea0">See your Transaction</a>
                            <a href="/" class="btn mt-2 btn-sm text-white p-3" style="background-color:#5f9ea0">Contact Teller</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection
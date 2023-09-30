@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('/css/login.css')}}">
@endpush
@section('content')

<main class="form-signup">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <a href="{{url('/')}}">
            <img class="mb-4 rounded-circle shadow bg-body" src="{{asset('/image/Moonride-Logo.jpg')}}" alt="Moonride Logo" height="100">
        </a>
        <h1 class="h3 fw-normal">Create your Account</h1>
        <h1 class="h6 mb-3 fw-normal">Create an account to view and manage.</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="name" class="form-control mb-2 bg-white @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" id="floatingInput" placeholder="Input Name">
                    <label for="floatingInput">Name</label>
                </div>
                @error('name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" class="form-control mb-2 bg-white @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                @error('email')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" class="form-control mb-2 bg-white @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}" required autocomplete="birthdate" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Date of Birth</label>
                </div>
                @error('birthdate')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" class="form-control mb-2 bg-white @error('cellphone_number') is-invalid @enderror" name="cellphone_number" value="{{ old('cellphone_number') }}" required autocomplete="cellphone_number" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Phone Number</label>
                </div>
                @error('cellphone_number')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select mb-2" name="gender">  
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                    <label for="floatingSelect">Gender</label>
                </div>
                @error('gender')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-8">
                <div class="form-floating">
                    <input type="text" class="form-control mb-2 bg-white @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Address</label>
                </div>
                @error('address')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control mb-2 bg-white @error('password') is-invalid @enderror" name="password" required  autocomplete="new-password" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                @error('password')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control bg-white" name="password_confirmation" required  autocomplete="new-password" id="floatingPasswordConfirm" placeholder="Confirm Password">
                    <label for="floatingPasswordConfirm">Confirm Password</label>
                </div>
            </div>
        </div>
       
        <button class="w-100 btn btn-lg btn-warning" type="submit">Sign Up</button>
        <hr>
        <a class="btn btn-link" href="{{ route('login') }}">
            {{ __('Already have an account? Back to Login.') }}
        </a>
        <p class="mt-5 mb-3 text-muted">&copy; BSIT-2023</p>
    </form>
</main>
@endsection

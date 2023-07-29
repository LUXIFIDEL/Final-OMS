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
        <div class="form-floating">
            <input type="name" class="form-control mb-2 bg-white @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" id="floatingInput" placeholder="Input Name">
            <label for="floatingInput">Name</label>
        </div>
        @error('name')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="form-floating">
            <input type="email" class="form-control mb-2 bg-white @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        @error('email')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="form-floating">
            <input type="password" class="form-control mb-2 bg-white @error('password') is-invalid @enderror" name="password" required  autocomplete="new-password" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        @error('password')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="form-floating">
            <input type="password" class="form-control bg-white" name="password_confirmation" required  autocomplete="new-password" id="floatingPasswordConfirm" placeholder="Confirm Password">
            <label for="floatingPasswordConfirm">Confirm Password</label>
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
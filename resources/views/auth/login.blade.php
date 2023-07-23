@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('/css/login.css')}}">
@endpush
@section('content')
<main class="form-signin">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <a href="{{url('/')}}">
            <img class="mb-4 rounded-circle shadow bg-body" src="{{asset('/image/Moonride-Logo.jpg')}}" alt="Moonride Logo" height="100">
        </a>
        <h1 class="h3 mb-3 fw-normal">Please sign in your Account</h1>
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
            <input type="password" class="form-control bg-white @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        @error('password')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="checkbox mb-3">
            <label>
            <input type="checkbox" value="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-warning" type="submit">Sign in</button>
        {{-- @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif --}}
        <hr>
        <a class="w-80 btn btn-lg btn-success" href="{{ route('register') }}">Create Account</a>
        <p class="mt-5 mb-3 text-muted">&copy; BSIT-2023</p>
    </form>
</main>
@endsection

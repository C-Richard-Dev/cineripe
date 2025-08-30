@extends('layouts.app') {{-- app.blade já importa Bootstrap e custom.css --}}

@section('content')
<div class="row justify-content-center" style="min-height: 100vh; bg-dark;">
    <div class="col-md-6 col-lg-4 d-flex align-items-center">
        <div class="card shadow-sm w-100" style="background-color: #ffffff;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4" style="color: #ff0000;">Login</h3>

                <!-- Session Status -->
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me" style="color: #ff0000;">
                            Remember me
                        </label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="color: #ff0000;">
                                Forgot your password?
                            </a>
                        @endif

                        <button type="submit" class="btn" style="background-color: #ff0000; color: #ffffff;">
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

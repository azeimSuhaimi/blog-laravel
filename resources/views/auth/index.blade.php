 
@extends('layouts.app_auth')
 
@section('title', 'login page')
 
@section('content')
            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-6 col-lg-6 col-md-6">
    
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>

                                            @include('partials.popup')
                                        </div>
                                        <form class="user" action="{{route('auth.login')}}" method="POST">
                                            @csrf

                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror  " id="username" 
                                                    placeholder="Enter username" name="username" value="{{ old('username') }}">
                                                    @error('username')
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
    
                                            
                                            </div>

                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                                    id="password" placeholder="password" name="password" value="{{ old('password') }}">
                                                    @error('password')
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" name="remember_token"  class="custom-control-input" id="remember">
                                                    <label class="custom-control-label" for="remember">Remember
                                                        Me</label>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                            <hr>
                                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> Login with Google
                                            </a>
                                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                            </a>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="{{route('forgot_password')}}">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="{{route('register')}}">Create an Account!</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="{{route('/')}}">bakc to pages</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
    
            </div>
@endsection
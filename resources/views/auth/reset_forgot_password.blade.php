@extends('layouts.app_auth')
 
@section('title', 'reset page')
 

 
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
                                        <h1 class="h4 text-gray-900 mb-4">reset new password</h1>

                                        @include('partials.popup')

                                    </div>
                                    <form class="user" method="post" action="{{route('reset_password')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="password1">New password</label>
                                            <input type="password" class="form-control" name="password1" value="{{ old('password1') }}" id="password1" placeholder="New Password">
                                            @error('password1')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                          </div>

                                          <input type="hidden" name="email" value="{{ $email }}">

                                          <div class="form-group">
                                            <label for="password2">Comfirm Password</label>
                                            <input type="password" class="form-control" name="password2" value="{{ old('password2') }}" id="password2" placeholder="Comfirm Password">
                                            @error('password2')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                          </div>

                                          <button type="submit" class="btn btn-primary">submit</button>
                                    </form>
                                    <hr>
                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


@endsection
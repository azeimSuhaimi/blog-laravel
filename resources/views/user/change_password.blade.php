@extends('layouts.app')
 
@section('title', 'change password page')
 

 
@section('content')


        <!-- Project Card Example -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase">change password</h6>
        </div>
        <div class="card-body ">
            <div class="container">

                
                @include('partials.popup')


                <form action="{{route('user.change_password_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="password">Current Password</label>
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="password" placeholder="Current Password">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="password1">New password</label>
                        <input type="password" class="form-control" name="password1" value="{{ old('password1') }}" id="password1" placeholder="New Password">
                        @error('password1')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="password2">Comfirm Password</label>
                        <input type="password" class="form-control" name="password2" value="{{ old('password2') }}" id="password2" placeholder="Comfirm Password">
                        @error('password2')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">submit</button>
                </form>
            </div>
        </div>
        </div>


@endsection
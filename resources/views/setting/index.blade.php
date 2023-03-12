@extends('layouts.app')
 
@section('title', 'setting page')
 
@section('content')
@include('partials.popup')
<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-7">
            
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">General setting</h6>
            </div>
            <div class="card-body">
                <form action="{{route('setting.edit')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="email">email </label>
                        <input type="text" class="form-control" name="email" value="{{ $setting->email }}" id="email" placeholder="Current email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="facebook">facebook </label>
                        <input type="text" class="form-control" name="facebook" value="{{ $setting->facebook }}" id="facebook" placeholder="Current facebook">
                        @error('facebook')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="twitter">twitter </label>
                        <input type="text" class="form-control" name="twitter" value="{{ $setting->twitter }}" id="twitter" placeholder="Current twitter">
                        @error('twitter')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="linkedin">linkedin </label>
                        <input type="text" class="form-control" name="linkedin" value="{{ $setting->linkedin }}" id="linkedin" placeholder="Current linkedin">
                        @error('linkedin')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="whatsapp">whatsapp </label>
                        <input type="text" class="form-control" name="whatsapp" value="{{ $setting->whatsapp }}" id="whatsapp" placeholder="Current whatsapp">
                        @error('whatsapp')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="youtube">youtube </label>
                        <input type="text" class="form-control" name="youtube" value="{{ $setting->youtube }}" id="youtube" placeholder="Current youtube">
                        @error('youtube')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">description </label>
                        <input type="text" class="form-control" name="description" value="{{ $setting->description }}" id="description" placeholder="Current description">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">edit</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-5">
        
                    
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                    
                </div>
            </div>

    </div>
</div>
@endsection

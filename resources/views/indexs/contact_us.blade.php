@extends('layouts.app_blog')
 
@section('title', 'contact us page')
 
@section('content')
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
       
        <div class="card-body">

            <form action="{{route('contact_us.post')}}" method="post">
                @csrf

                    <div class="form-group mt-3">
                        <label class="fw-bold text-uppercase" for="email">email</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="your email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="form-group mt-3">
                        <label class="fw-bold text-uppercase" for="name">name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="your name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="form-group mt-3">
                        <label class="fw-bold text-uppercase" for="phone">phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" id="phone" placeholder="your phone">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                                        
                    <div class="form-group mt-3">
                        <label class="fw-bold text-uppercase" for="messege">messege</label>
                        <textarea name="messege" class="form-control" id="messege" cols="30" rows="10">{{ old('messege') }}</textarea>
                        
                        @error('messege')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">send</button>

            </form>
        </div>
    </div>
@endsection
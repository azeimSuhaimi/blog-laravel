<!-- resources/views/child.blade.php -->
 
@extends('layouts.app')
 
@section('title', 'create products page')
 
@section('content')
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">create products</h6>
        </div>
        <div class="card-body">
           
            @include('partials.popup')
            <form action="{{route('products.store')}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="name">name product</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" name="name" value="{{ old('name') }}" id="name" placeholder="name product">
                    @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">description product</label>
                    <input type="text" class="form-control {{$errors->has('description') ? 'is-invalid' :''}}" name="description" value="{{ old('description') }}" id="description" placeholder="description product">
                    @error('description')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">price product</label>
                    <input type="text" class="form-control {{$errors->has('price') ? 'is-invalid' :''}}" name="price" value="{{ old('price') }}" id="price" placeholder="price product">
                    @error('price')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quantity">quantity product</label>
                    <input type="text" class="form-control {{$errors->has('quantity') ? 'is-invalid' :''}}" name="quantity" value="{{ old('quantity') }}" id="quantity" placeholder="quantity product">
                    @error('quantity')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">submit</button>
            </form>
        </div>
    </div>
@endsection



                                                
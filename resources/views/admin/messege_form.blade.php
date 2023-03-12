@extends('layouts.app')
 
@section('title', 'messege form page')
 
@section('content')
<div class="card shadow mb-4">
       
    <div class="card-body">

        @include('partials.popup')
        <form action="{{route('msgsub.send')}}" method="post">
            @csrf

                                    
                <div class="form-group">
                    <label for="messege">messege</label>
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
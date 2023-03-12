@extends('layouts.app')
 
@section('title', 'view messege page')
 
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">view messege</h6>
    </div>
    <div class="card-body">
        <a class="btn btn-success" href="#" onclick="window.history.back()">Go back</a>
        
        @include('partials.popup')

        {{$messege->email}}
        {{$messege->name}}
        {{$messege->phone}}
        {{$messege->messege}}
        {{$messege->time}}

    </div>
</div>
@endsection
@extends('layouts.app')
 
@section('title', 'view posts page')
 
@section('content')
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
            </div>
            <div class="card-body">
                <a class="btn btn-success" href="#" onclick="window.history.back()">Go back</a>

                <h1>{{$post->title}}</h1>
                <?= $post->content?>

                {{$post->content}}
                
            </div>
        </div>
@endsection




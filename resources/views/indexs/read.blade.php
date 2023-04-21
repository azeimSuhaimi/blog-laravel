@extends('layouts.app_blog')
 
@section('title', 'read post page')
 
@section('content')
<a class="btn btn-success" href="#" onclick="window.history.back()">Go back</a>

<div>
    <img class="img-fluid rounded mx-auto d-block" src="assets/posts_images/{{$post->image}}" alt="">
    <p class="text-uppercase mt-5 fw-bold">{{$post->created_at}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <a href="#" class="  btn btn-primary">{{$post->editor}}</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     {{$post->category}}</p>

    <h1> {{$post->title}} </h1>

    <?= $post->content?>

    <a class="btn btn-success" href="#" onclick="window.history.back()">Go back</a>
</div>
    
    

@endsection
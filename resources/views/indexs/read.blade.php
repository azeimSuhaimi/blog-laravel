@extends('layouts.app_blog')
 
@section('title', 'read post page')
 
@section('content')
<a class="btn btn-success" href="#" onclick="window.history.back()">Go back</a>
    {{$post->title}}
    <?= $post->content?>
    {{$post->editor}}
@endsection
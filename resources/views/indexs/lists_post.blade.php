@extends('layouts.app_blog')
 
@section('title', 'list all post page')
 
@section('content')

<div class="padding-30 rounded bordered">
    <div class="row">

        <div class="section-header">
            @if (request('search'))
                <h3 class="section-title"> keyword search <span class="fw-bold text-uppercase">{{request('search')}}</span> Post</h3>
            @endif
            @if (request('category'))
                <h3 class="section-title"> keyword category <span class="fw-bold text-uppercase ">{{request('category')}}</span> Post</h3>
            @endif
            @if (request('category') == '' && request('search') == '')
            <h3 class="section-title">Latest Post</h3>
                
            @endif
        </div>

        @foreach ($post_all as $list )
        
            <div class="col-md-12 col-sm-6">
                <!-- post  -->
                <div class="post post-list clearfix">
                    <div class="thumb rounded">
                        <span class="post-format-sm">
                            <i class="icon-picture"></i>
                        </span>
                        <a href="{{route('read.post').'?id='.$list->id}}">
                            <div class="inner">
                                <img src="assets/posts_images/{{$list->image}}" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="details">
                        <ul class="meta list-inline mb-3">
                            <li class="list-inline-item">
                                <a href="{{route('read.post').'?id='.$list->id}}">
                                    <!--
                                    <img src="images/other/author-sm.jpg" class="author" alt="">
                                    -->
                                    {{$list->editor}}
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{route('read.post').'?id='.$list->id}}">{{$list->category}}</a>
                            </li>
                            <li class="list-inline-item">{{$list->created_at}}</li>
                        </ul>
                        <h5 class="post-tile">
                            <a href="{{route('read.post').'?id='.$list->id}}">
                                {{$list->title}}
                            </a>
                        </h5>
                        <p class="excerpt mb-0">
                            
                        </p>
                        <div class="post-bottom clearfix d-flex align-items-center">
                            <div class="social-share me-auto">
                                <button class="toggle-button icon-share"></button>
                                <ul class="icons list-unstyled list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><i class="fab fa-pinterest"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><i class="fab fa-telegram-plane"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"><i class="far fa-envelope"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="more-button float-end">
                                <a href="#"><span class="icon-options"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

        <div class="text-center d-flex justify-content-end">
            {{ $post_all->links() }}

        </div>
    <!--
        <div class="text-center">
            <button class="btn btn-simple">Load More</button>
        </div>
    -->
    </div>
</div>
@endsection
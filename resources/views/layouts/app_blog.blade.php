
<?php

$setting =  DB::table('setting')->get()->first();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="assets_blog/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel=" stylesheet" href="assets_blog/css/slick.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets_blog/style.css">


        <!-- javascripts  -->
        <script src="assets_blog/js/jquery.min.js"></script>
        <script src="assets_blog/js/popper.min.js"></script>
        <script src="assets_blog/js/bootstrap.min.js"></script>
        <script src="assets_blog/js/slick.min.js"></script>
        <script src="assets_blog/js/jquery.sticky-sidebar.min.js"></script>
        <script src="assets_blog/main.js"></script>

        
</head>

<body>
    <div class="site-wrapper">
        <div class="main-overlay"></div>
        <header class="header-default">
            <nav class="navbar navbar-expand-lg">
                <div class="container-xl">
                    <!-- logo  -->
                    <a href="{{route('/')}}" class="navbar-brand">
                        <img src="assets_blog/images/logo.svg" alt="">
                    </a>

                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item  {{  Request::is('/') ? 'active':'' }}">
                                <a href="{{route('/')}}" class="nav-link ">Home</a>

                            </li>
                            <li class="nav-item {{  Request::is('list_post') ? 'active':'' }}">
                                <a href="{{route('list_post')}}" class="nav-link">Latest</a>
                            </li>

                            <li class="nav-item {{  Request::is('list_product') ? 'active':'' }}">
                                <a href="{{route('list_product')}}" class="nav-link">list product</a>
                            </li>

                            <li class="nav-item {{  Request::is('contact_us') ? 'active':'' }}">
                                <a href="{{route('contact_us')}}" class="nav-link">Contact Us</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('auth')}}" class="nav-link">Login</a>
                            </li>
                        </ul>
                    </div>

                    <!-- right side of header  -->
                    <div class="header-right">
                        <ul class="social-icons list-unstyled list-inline mb-0">
                            @if ($setting->facebook)
                            
                                <li class="list-inline-item">
                                    <a href="{{url($setting->facebook)}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
                            @endif

                            @if ($setting->twitter)
                            
                                <li class="list-inline-item">
                                    <a href="{{url($setting->twitter)}}" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                            @endif

                            
                            @if ($setting->linkedin)
                            
                                <li class="list-inline-item">
                                    <a href="{{url($setting->linkedin)}}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                </li>
                            @endif

                            @if ($setting->youtube)
                            
                                <li class="list-inline-item">
                                    <a href="{{url($setting->youtube)}}" target="_blank"><i class="fab fa-youtube"></i></a>
                                </li>
                            @endif

                            @if ($setting->whatsapp)
                                    
                                <li class="list-inline-item">
                                    <a href="{{url($setting->whatsapp)}}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                </li>
                            @endif



                        </ul>

                        <!-- buttons  -->
                        <div class="header-buttons">
                            <a href="{{route('cart_product')}}" class=" icon-button">
                                cart <p id="cart_icon">
                                    @if (session()->has('cart'))
                                        
                                        @foreach (session('cart') as $data )
                                            @if ($loop->last)
                                                
                                                {{$loop->count}}
                                            @endif
                                        @endforeach
                                    @else
                                        0
                                    @endif            
                                    </p>
                            </a>
                            <button class="search icon-button">
                                <i class="icon-magnifier"></i>
                            </button>
                            <button class="burger-menu icon-button">
                                <span class="burger-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>




        </header>

@include('partials.popup')


@if (Request::is('/'))
<!-- section starts  -->
<section id="hero">
    <div class="container-xl">
        <div class="row gy-4">
            <div class="col-lg-8">

                @if ($posts)
                    
                    <div class="post featured-post-lg">
                        <div class="details clearfix">
                            <a href="{{route('read.post').'?id='.$posts->id}}" class="category-badge">{{ $posts->category}}</a>
                            <h2 class="post-title">
                                <a href="{{route('read.post').'?id='.$posts->id}}">{{ $posts->title}}</a>
                            </h2>
                            <ul class="meta list-inline mb-0">
                                <li class="list-inline-item">
                                    <a href="{{route('read.post').'?id='.$posts->id}}">Techie Coder</a>
                                </li>
                                <li class="list-inline-item">{{ $posts->created_at}}</li>
                            </ul>
                        </div>
                        <a href="{{route('read.post').'?id='.$posts->id}}">
                            <div class="thumb rounded">
                                <div class="inner data-bg-image" data-bg-image="assets/posts_images/{{$posts->image}}">
                                </div>
                            </div>
                        </a>
                    </div>

                @else
                    <h1>editor not pick for post</h1>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="post-tabs rounded bordered">
                    <ul class="nav nav-tabs nav-pills nav-fill" id="postTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button aria-controls="popular" aria-selected="true" class="nav-link active"
                                data-bs-target="#popular" data-bs-toggle="tab" id="popular-tab" role="tab"
                                type="button">
                                Popular
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button aria-controls="recent" aria-selected="false" class="nav-link"
                                data-bs-target="#recent" data-bs-toggle="tab" id="recent-tab" role="tab"
                                type="button">
                                Recent
                            </button>
                        </li>

                    </ul>

                    <!-- content  -->
                    <div class="tab-content" id="postsTabContent">
                        <!-- loader -->
                        <div class="lds-dual-ring"></div>
                        <!-- pop post  -->

                        <div class="tab-pane fade show active" id="popular" aria-labelledby="popular-tab"
                            role="tabpanel">

                            <?php 
                             $pop_post = DB::table('posts')->take(5)->orderBy('count','desc')->get();
                            ?>
                            
                            @if (!$pop_post->isEmpty())
                                
                                @foreach ( $pop_post as $post)
                                    <!-- post  -->
                                    <div class="post post-list-sm circle">
                                        <div class="thumb circle">
                                            <a href="{{route('read.post').'?id='.$post->id}}">
                                                <div class="inner">
                                                    <img src="assets/posts_images/{{ $post->image}}" alt="">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="details clearfix">
                                            <h6 class="post-title my-0">
                                                <a href="{{route('read.post').'?id='.$post->id}}">{{ $post->title}}</a>
                                            </h6>
                                            <ul class="meta list-inline mt-1 mb-0">
                                                <li class="list-inline-item">{{ $post->created_at}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                
                                @endforeach

                                @else
                                <P>no content </P>
                            @endif

                        </div>

                        <!-- recent  -->
                        <div class="tab-pane fade" id="recent" aria-labelledby="recent-tab" role="tabpanel">
                            <?php 
                                
                                $recent_post = DB::table('posts')->take(5)->orderBy('created_at','desc')->get();
                                ?>

                                @if (!$recent_post->isEmpty())
                                    
                                    @foreach ( $recent_post as $post)
                                            <!-- post  -->
                                            <div class="post post-list-sm circle">
                                                <div class="thumb circle">
                                                    <a href="{{route('read.post').'?id='.$post->id}}">
                                                        <div class="inner">
                                                            <img src="assets/posts_images/{{ $post->image}}" alt="">
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="details clearfix">
                                                    <h6 class="post-title my-0">
                                                        <a href="{{route('read.post').'?id='.$post->id}}">{{ $post->title}}</a>
                                                    </h6>
                                                    <ul class="meta list-inline mt-1 mb-0">
                                                        <li class="list-inline-item">{{ $post->created_at}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                
                                    @endforeach
                                @else
                                    <p>no content</p>
                                @endif


                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</section>
    
@endif

        <!-- main content  -->

        <section class="main-content">
            <div class="container-xl">
                <div class="row gy-4">
                    
                    <!-- left part 1st section  -->
                    <div class="col-lg-8">
                        
                        @yield('content')

                        @if (Request::is('/'))
                        
                            <div class="section-header">
                                <h3 class="section-title">Editor's Pick</h3>
                            </div>

                            <div class="padding-30 rounded bordered">
                                <div class="row gy-5">
                                    <?php 
                                            $editor_pick = DB::table('posts')->where('pick', true)->take(5)->orderBy('created_at','desc')->get();
                                        ?>
                                        @foreach ( $editor_pick as $pick )
                                            
                                            @if ($loop->iteration == 1)
                                                
                                                <div class="col-sm-6">
            
                                                    <!-- post  -->
                                                    <div class="post">
                                                        <div class="thumb rounded">
                                                            <a href="{{route('list_post').'?category='.$pick->category}}" class="category-badge position-absolute">{{$pick->category}}</a>
                                                            <span class="post-format">
                                                                <i class="icon-picture"></i>
                                                            </span>
                                                            <a href="{{route('read.post').'?id='.$pick->id}}">
                                                                <div class="inner">
                                                                    <img src="assets/posts_images/{{$pick->image}}" alt="">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <ul class="meta list-inline mt-4 mb-0">
                                                            <li class="list-inline-item">
                                                                <a href="{{route('read.post').'?id='.$pick->id}}">
                                                                    <!--<img class="author" src="images/other/author-sm.jpg" alt="">-->
                                                                    {{$pick->editor}}
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item">{{$pick->created_at}}</li>
                                                        </ul>
                                                        <h5 class="post-title mb-3 mt-3">
                                                            <a href="{{route('read.post').'?id='.$pick->id}}">{{$pick->title}}</a>
                                                        </h5>
                                                        <p class="excerpt mb-0">
                                                            
                
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif

                                            @endforeach

                                            <div class="col-sm-6">
                                                @foreach ( $editor_pick as $pick )
                                                
                                                @if ($loop->iteration > 1)
                                                    
                                                <div class="post post-list-sm square">
                                                    <div class="thumb rounded">
                                                        <a href="{{route('read.post').'?id='.$pick->id}}">
                                                            <div class="inner">
                                                                <img src="assets/posts_images/{{$pick->image}}" alt="">
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="details clearfix">
                                                        <h6 class="post-title my-0">
                                                            <a href="{{route('read.post').'?id='.$pick->id}}">
                                                                {{$pick->title}}
                                                            </a>
                                                        </h6>
                                                        <ul class="meta list-inline mt-1 mb-0">
                                                            <li class="list-inline-item">{{$pick->created_at}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            
                                                @endif

                                                @endforeach
                                            </div>

                                            
                                            
                                             
            
    
                                </div>
                            </div>
    
                            <div class="spacer" data-height="50"></div>
    
                            <div class="section-header">
                                <h3 class="section-title">Latest Posts</h3>
                            </div>
    
                            <div class="padding-30 rounded bordered">
                                <div class="row">

                               
                            
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

                        @endif

                        <!-- left part over here  -->
                    </div>

                    <!-- right part starts from here  -->

                    <div class="col-lg-4">
                        <div class="sidebar">
                            @if ($setting->description)
                                
                                <div class="widget rounded">
                                    <div class="widget-about text-center">
                                        <img src="assets_blog/images/logo.svg" alt="" class="logo">
                                        <p class="mb-4" style="text-align: justify;">{{$setting->description}}</p>
                                        <ul class="social-icons list-unstyled list-inline mb-0">
                                            @if ($setting->facebook)
                            
                                                <li class="list-inline-item">
                                                    <a href="{{url($setting->facebook)}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                                </li>
                                            @endif
                
                                            @if ($setting->twitter)
                                            
                                                <li class="list-inline-item">
                                                    <a href="{{url($setting->twitter)}}" target="_blank"><i class="fab fa-twitter"></i></a>
                                                </li>
                                            @endif
                
                                            
                                            @if ($setting->linkedin)
                                            
                                                <li class="list-inline-item">
                                                    <a href="{{url($setting->linkedin)}}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                                </li>
                                            @endif
                
                                            @if ($setting->youtube)
                                            
                                                <li class="list-inline-item">
                                                    <a href="{{url($setting->youtube)}}" target="_blank"><i class="fab fa-youtube"></i></a>
                                                </li>
                                            @endif
                
                                            @if ($setting->whatsapp)
                                                    
                                                <li class="list-inline-item">
                                                    <a href="{{url($setting->whatsapp)}}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                </li>
                                            @endif
                
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <?php

                                $popular_post = DB::table('posts')->take(5)->orderBy('count','desc')->get();
                            ?>

                            @if ($popular_post)
                                
                                <div class="widget rounded">
                                    <div class="widget-header text-center">
                                        <h3 class="widget-title">Popular Posts</h3>
                                    </div>
                                    <div class="widget-content">
                                        @foreach ( $popular_post as $post)
                                        
                                            <div class="post post-list-sm circle">
                                                <div class="thumb circle">
                                                    <span class="number">{{$loop->iteration}}</span>
                                                    <a href="{{route('read.post').'?id='.$post->id}}">
                                                        <div class="inner">
                                                            <img src="assets/posts_images/{{$post->image}}" alt="">
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="details clearfix">
                                                    <h6 class="post-title my-0">
                                                        <a href="{{route('read.post').'?id='.$post->id}}">{{$post->title}}</a>
                                                    </h6>
                                                    <ul class="meta list-inline mt-1 mb-0">
                                                        <li class="list-inline-item">{{$post->created_at}}</li>
                                                    </ul>
                                                </div>
                                            </div>

                                        @endforeach
                                        
                                    </div>
                                </div>
                            @endif


                            <?php 
                            $category = DB::table('posts')->select('category')->distinct()->get();
                            ?>

                                @if ($category)
                                    
                                    <div class="widget rounded">
                                        <div class="widget-header text-center">
                                            <h3 class="widget-title">Explore Topics</h3>
                                        </div>
                                        <div class="widget-content">
                                            <ul class="list">
                                                @foreach ($category as $c )
                                                    <li><a class="text-capitalize" href="{{route('list_post').'?category='.$c->category}}">{{$c->category}}</a><span>({{DB::table('posts')->where('category', '=', $c->category)->count();}})</span></li>
                                                @endforeach
        
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Newsletter</h3>
                                </div>
                                <div class="widget-content">
                                    <span class="newsletter-headline text-center mb-3">Join 50,000 subscribers</span>
                                    <form action="{{route('subscribe')}}" method="POST">
                                        @csrf
                                        <div class="mb-2">
                                            <input type="text" class="form-control w-100 text-center"
                                                placeholder="Email address..." name="email" value="{{ old('email') }}" id="email">
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <button type="submit" class="btn btn-default btn-full">subscribe</button>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>




        <footer>
            <div class="container-xl">
                <div class="footer-inner">
                    <div class="row d-flex align-items-center gy-4">
                        <div class="col-md-4">
                            <span class="copyright">&copy; 2021 TC Blogs</span>
                        </div>
                        <div class="col-md-4 text-center">
                            <ul class="social-icons list-unstyled list-inline mb-0">
                                @if ($setting->facebook)
                                    
                                    <li class="list-inline-item">
                                        <a href="{{url($setting->facebook)}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                @endif
                    
                                @if ($setting->twitter)
                                
                                    <li class="list-inline-item">
                                        <a href="{{url($setting->twitter)}}" target="_blank"><i class="fab fa-twitter"></i></a>
                                    </li>
                                @endif
                    
                                
                                @if ($setting->linkedin)
                                
                                    <li class="list-inline-item">
                                        <a href="{{url($setting->linkedin)}}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                    </li>
                                @endif
                    
                                @if ($setting->youtube)
                                
                                    <li class="list-inline-item">
                                        <a href="{{url($setting->youtube)}}" target="_blank"><i class="fab fa-youtube"></i></a>
                                    </li>
                                @endif
                    
                                @if ($setting->whatsapp)
                                        
                                    <li class="list-inline-item">
                                        <a href="{{url($setting->whatsapp)}}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <a href="#" id="return-to-top" class="float-md-end">
                                <i class="icon-arrow-up"></i>
                                Back to Top
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>




    </div>


    <!-- canvas menu  -->
    <div class="canvas-menu d-flex align-items-end flex-column">
        <button class="btn-close" aria-label="Close" type="button"></button>

        <div class="logo">
            <img src="assets_blog/images/logo.svg" alt="">
        </div>
        <nav>
            <ul class="vertical-menu">
                <li class="{{Request::is('/') ? 'active':'' }}"><a href="{{route('/')}}">Home</a></li>
                <li class="{{Request::is('liat_post') ? 'active':'' }}"><a href="{{route('list_post')}}">Latest</a></li>
                
                <li class="{{Request::is('contact_us') ? 'active':'' }}"><a href="{{route('contact_us')}}">Contact Us</a></li>
                <li><a href="{{route('auth')}}">Login</a></li>
            </ul>
        </nav>


        <ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
            @if ($setting->facebook)
                                
                <li class="list-inline-item">
                    <a href="{{url($setting->facebook)}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                </li>
            @endif

            @if ($setting->twitter)
            
                <li class="list-inline-item">
                    <a href="{{url($setting->twitter)}}" target="_blank"><i class="fab fa-twitter"></i></a>
                </li>
            @endif

            
            @if ($setting->linkedin)
            
                <li class="list-inline-item">
                    <a href="{{url($setting->linkedin)}}" target="_blank"><i class="fab fa-linkedin"></i></a>
                </li>
            @endif

            @if ($setting->youtube)
            
            <li class="list-inline-item">
                <a href="{{url($setting->youtube)}}" target="_blank"><i class="fab fa-youtube"></i></a>
            </li>
        @endif

        @if ($setting->whatsapp)
                
            <li class="list-inline-item">
                <a href="{{url($setting->whatsapp)}}" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </li>
        @endif


        </ul>
    </div>


    <!-- search pop up  -->
    <div class="search-popup">
        <button class="btn-close" aria-label="Close" type="button"></button>

        <div class="search-content">
            <div class="text-center">
                <h3 class="mb-4 mt-0">Press ESC to close</h3>
            </div>

            <form action="{{route('list_post')}}" method="GET" class="d-flex search-form">
                <input type="text" name="search" value="{{request('search')}}" placeholder="Search and press enter ..." aria-label="Search"
                    class="form-control me-2">
                <button class="btn btn-default btn-lg" type="submit">
                    <i class="icon-magnifier"></i>
                </button>
            </form>
        </div>
    </div>










</body>

</html>
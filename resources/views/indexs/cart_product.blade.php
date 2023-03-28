@extends('layouts.app_blog')
 
@section('title', 'cart product page')
 
@section('content')
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
       
        <div class="card-body">

            
            
            <div id="cart">
                <h2>Shopping Cart</h2>
                @include('partials.popup')
                <div class="row">
                    <?php 
                        $total = 0;
                        ?>

                    @if (session()->has('cart'))
                    
                        @foreach (session('cart') as $data )
                                <div class="col-lg-6">
                                    <div class="card mt-2" >
                                        <img src="assets/images_product/empty.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <?php 
                                                $total += $data['price'] * $data['quantity'];
                                            ?>
                                            <h5 class="card-title">{{$data['name']}}</h5>
                                            <p class="card-text">price rm {{$data['price']}}</p>
                                            <p class="card-text">quantity {{$data['quantity']}}</p>
                                            <p class="card-text">sub total {{$data['price'] * $data['quantity']}}</p>
                                            <form action="{{route('cart_product.add')}}" method="get">
                                                @csrf
                                                <input type="hidden"  name="id" value="{{$data['id']}}">
                                                <input type="number" class="form-control" name="quantity" value="{{$data['quantity']}}"> 
                                                <button type="submit" class="btn btn-primary">add</button>
                                            </form>
                                            <a href="{{route('cart_product.remove')}}?id={{$data['id']}}" class="btn btn-primary mt-2">remove</a>
                                        </div>
                                    </div>

                                </div>
                        @endforeach

                    @else

                    <h4>no cart have been add</h4>

                    @endif

                </div>
                <ul id="cart-items"></ul>
                <p>Total: $<span id="cart-total">{{$total}}</span></p>

                <a href="{{route('checkout')}}" class="btn btn-warning">checkout</a>
            </div>

        
        </div>
    </div>


@endsection
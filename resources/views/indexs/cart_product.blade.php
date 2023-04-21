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

                    @if (Cart::content())
                    
                        @foreach (Cart::content() as $data)
                                <div class="col-lg-6">
                                    <div class="card mt-2" >
                                        <img src="assets/images_product/empty.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <?php 
                                                $total += $data->price * $data->qty;
                                            ?>
                                            <h5 class="card-title">{{$data->name}}</h5>
                                            <p class="card-text">price rm {{$data->price}}</p>
                                            <p class="card-text">quantity {{$data->qty}}</p>
                                            <p class="card-text">sub total {{$data->total}}</p>
                                            <form action="{{route('cart_product.add')}}" method="get">
                                                @csrf
                                                <input type="hidden"  name="id" value="{{$data->id}}">
                                                <input type="hidden"  name="rowid" value="{{$data->rowId}}">
                                                <input type="number" class="form-control" name="quantity" value="{{$data->qty}}"> 
                                                <button type="submit" class="btn btn-primary">add</button>
                                            </form>
                                            <a href="{{route('cart_product.remove')}}?id={{$data->rowId}}" class="btn btn-primary mt-2">remove</a>
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
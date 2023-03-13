@extends('layouts.app_blog')
 
@section('title', 'cart product page')
 
@section('content')
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
       
        <div class="card-body">

            <div id="cart">
                <h2>Shopping Cart</h2>
                <ul id="cart-items"></ul>
                <p>Total: $<span id="cart-total">0</span></p>
            </div>

        
        </div>
    </div>


@endsection
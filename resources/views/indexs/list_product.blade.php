@extends('layouts.app_blog')
 
@section('title', 'list productpage')
 
@section('content')
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
       
        <div class="card-body">

            <div class="row">
                @foreach ( $products as $product )
                    
                    <div class="col-4">
                        <div class="card">
                            <img src="assets/images_product/{{$product->image}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->name}}</h5>
                                <p class="card-text">{{$product->description}}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">rm {{$product->price}}</li>
                                <li class="list-group-item">quantity left :{{$product->quantity}}</li>
                            </ul>
                            <div class="card-body">
                                <a class="add-to-cart btn btn-primary" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}">add</a>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center d-flex justify-content-end">
                {{ $products->links() }}
    
            </div>
        
        </div>
    </div>

    <script>
            // Get the add-to-cart buttons
            const addToCartButtons = document.querySelectorAll('.add-to-cart');

            // Add event listener to each button
            addToCartButtons.forEach(button => {
            button.addEventListener('click', addToCartClicked);
            });

            // Function to handle add-to-cart button click
            function addToCartClicked(event) {
            // Get the product details
            const button = event.target;
            const id = button.dataset.id;
            const name = button.dataset.name;
            const price = button.dataset.price;
            
            // Check if product already exists in cart
            const cartItems = getCartItems();
            const existingItem = cartItems.find(item => item.id === id);
            if (existingItem) {
                Swal.fire(
                        'The product?',
                        'you already add '+name,
                        'question'
                        )
            } else {
                cartItems.push({ id, name, price, quantity: 1 });
                Swal.fire(
                        'The product',
                        'you success add product '+name,
                        'success'
                        )
            }
            
            // Save cart items to local storage
            saveCartItems(cartItems);
            updateCartDisplayIcon();
            
            }

            // Function to get cart items from local storage
            function getCartItems() {
            return JSON.parse(localStorage.getItem('cartItems')) || [];
            }

            // Function to save cart items to local storage
            function saveCartItems(cartItems) {
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }
    </script>
@endsection
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
                                <form action="{{route('list_product.add')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <input type="hidden" name="name" value="{{$product->name}}">
                                    <input type="hidden" name="price" value="{{$product->price}}">
                                    <button  class=" btn btn-primary" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}">add</button>
                                </form>
                                
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


@endsection
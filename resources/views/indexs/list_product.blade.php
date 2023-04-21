@extends('layouts.app_blog')
 
@section('title', 'list productpage')
 
@section('content')
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
       
        <div class="card-body">
           
            <?php 

                ?>
            <table>
                   <thead>
                       <tr>
                           <th>Product</th>
                           <th>Qty</th>
                           <th>Price</th>
                           <th>Subtotal</th>
                       </tr>
                   </thead>
            
                   <tbody>
            
                       <?php foreach(Cart::content() as $row) :?>
            
                           <tr>
                               <td>
                                   <p><strong><?php echo $row->name; ?></strong></p>
                                   <p><?php echo ($row->options->has('size') ? $row->options->size : ''); ?></p>
                               </td>
                               <td><input type="text" value="<?php echo $row->qty; ?>"></td>
                               <td>$<?php echo $row->price; ?></td>
                               <td>$<?php echo $row->total; ?></td>
                           </tr>
            
                       <?php endforeach;?>
            
                   </tbody>
                   
                   <tfoot>
                       <tr>
                           <td colspan="2">&nbsp;</td>
                           <td>Subtotal</td>
                           <td><?php echo Cart::subtotal(); ?></td>
                       </tr>
                       <tr>
                           <td colspan="2">&nbsp;</td>
                           <td>Tax</td>
                           <td><?php echo Cart::tax(); ?></td>
                       </tr>
                       <tr>
                           <td colspan="2">&nbsp;</td>
                           <td>Total</td>
                           <td><?php echo Cart::total(); ?></td>
                       </tr>
                   </tfoot>
            </table>
            
            @if ($products[0] !== null )
                
            <div class="row">
                @foreach ( $products as $product )
                    
                    <div class="col-4">
                        <div class="card">
                            <img src="assets/images_product/{{$product->image}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->name}}</h5>
                                
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">RM {{$product->price}}</li>
                                <li class="list-group-item">quantity left :{{$product->quantity}}</li>
                            </ul>
                            <div class="card-body">
                                <form action="{{route('list_product.add')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <input type="hidden" name="name" value="{{$product->name}}">
                                    <input type="hidden" name="price" value="{{$product->price}}">
                                    <input type="hidden" name="quantity" value="{{$product->quantity}}">
                                    <button  class=" btn btn-primary" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}">add</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @else
            <h3>not product now</h3>
            @endif

            <div class="text-center d-flex justify-content-end">
                {{ $products->links() }}
    
            </div>
        
        </div>
    </div>


@endsection
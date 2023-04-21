<!-- resources/views/child.blade.php -->
 
@extends('layouts.app')
 
@section('title', 'show order page')
 
@section('content')

<a href="{{route('orders.index')}}" class="btn btn-primary">back</a>

<div class="card shadow mb-4">
       
    <div class="card-body">

@include('partials.popup')


<h2>payment status</h2>
<p> product name : {{$order->name}}</p>
<p> address : {{$order->address}}</p>
<p> phone : {{$order->phone}}</p>
<p> email : {{$order->email}}</p>
<p> reference : {{$order->reference}}</p>
<p> amount pay : {{$payment->amount}}</p>
<p> payment date : {{$payment->payment_date}}</p>
<table class="table table-bordered border-primary">
    <tr>
        <th>no</th>
        <th>product</th>
        <th>price</th>
        <th>quantity</th>
        <th>sub total</th>

    </tr>

    <?php 
        $total = 0;

    ?>

    @if ($order_items)
                        
    @foreach ($order_items as $data )

    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$data->product_name}}</td>
        <td>{{$data->price}}</td>
        <td>{{$data->quantity}}</td>
        <td>{{$data->quantity * $data->price}}</td>

        <?php 
            $total +=  $data->quantity * $data->price;
        ?>

    </tr>


    @endforeach

        <tr>
            <td colspan="3">total</td>
            <td colspan="2"><?= $total?></td>
        </tr>

    @else

        <tr>
            <td colspan="5">no cart have been add</td>
        </tr>

    @endif

</table>

@if ($order->pack == false)
    <form action="{{route('orders.update')}}" method="post">
        @csrf
        <input type="hidden" name="reference" value="{{$order->reference}}">
        <button type="submit" class="btn btn-primary">pack</button>
    </form>
@endif



    <p>view receip in toyyipay <a href="http://dev.toyyibpay.com/{{$payment->billcode}}"> see </a></p>
  



    
    </div>
</div>
@endsection
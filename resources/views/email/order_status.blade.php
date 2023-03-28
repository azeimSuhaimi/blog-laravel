<div class="card shadow mb-4">
       
    <div class="card-body">




<h2>payment status</h2>
<p> product name : {{$order->name}}</p>
<p> address : {{$order->address}}</p>
<p> phone : {{$order->phone}}</p>
<p> email : {{$order->email}}</p>
<p> reference : {{$order->reference}}</p>
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


@if ( $status_id == 1)
    ok
    <a href="http://dev.toyyibpay.com/{{$billcode}}"> see </a>
@endif

@if ( $status_id == 2)
    pending
    <a href="http://dev.toyyibpay.com/{{$billcode}}"> see </a>
    
@endif

@if ( $status_id == 3)
    fail
    <a href="http://dev.toyyibpay.com/{{$billcode}}"> see </a>
@endif

    
    </div>
</div>

<p>thank you for you email <a href="http://dev.toyyibpay.com/{{$billcode}}">see details</a></p>
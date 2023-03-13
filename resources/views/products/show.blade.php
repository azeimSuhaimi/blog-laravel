@extends('layouts.app')
 
@section('title', 'list product page')
 
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">list product</h6>
    </div>
    <div class="card-body">

        @include('partials.popup')
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>no</th>
                    <th>name</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>status</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td><a class="btn {{$product->status == true ? 'btn-success':'btn-danger'}}" href="{{$product->status == true ? route('products.deactive'):route('products.active')}}?id={{ $product->id }}">{{$product->status == true ? 'deactive product':'active product'}}</a></td>
                        <td><a class="btn btn-success" href="{{route('products.edit')}}?id={{$product->id}}">edit</a></td>
                    </tr>
            @endforeach
            </tbody>
        </table>
        
        <script>
           $(document).ready( function () {
            $('#table_id').DataTable();
        } );
         </script>

    </div>
</div>
@endsection

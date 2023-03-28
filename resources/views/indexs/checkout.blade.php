@extends('layouts.app_blog')
 
@section('title', 'checkout product page')
 
@section('content')
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
       
        <div class="card-body">
            <h2>Shopping Cart</h2>
            <table class="table table-bordered border-primary">
                <tr>
                    <th>no</th>
                    <th>image</th>
                    <th>name</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>sub total</th>
                </tr>

                <?php 
                    $total = 0;
                ?>

                @if (session()->has('cart'))
                                    
                @foreach (session('cart') as $data )
                    <?php 
                        $total += $data['price'] * $data['quantity'];
                    ?>
                    <tr>
                        <td>1</td>
                        <td><img src="assets/images_product/empty.jpg" class="" style="width:100px;height:100px" alt="..."></td>
                        <td>{{$data['name']}}</td>
                        <td>{{$data['price']}}</td>
                        <td>{{$data['quantity']}}</td>
                        <td>{{$data['price'] * $data['quantity']}}</td>
                    </tr>
                @endforeach

                    <tr>
                        <td colspan="3">total</td>
                        <td colspan="3"><?= $total?></td>
                    </tr>

                @else

                    <tr>
                        <td colspan="6">no cart have been add</td>
                    </tr>

                @endif

            </table>

            <form action="{{route('checkout.post')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="emailCheck">email</label>
                    <input type="text" class="form-control {{$errors->has('emailCheck') ? '' :''}}" name="emailCheck" value="{{ old('emailCheck') }}" id="emailCheck" placeholder="your email">
                    @error('emailCheck')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" name="name" value="{{ old('name') }}" id="name" placeholder="your name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="phone">phone</label>
                    <input type="text" class="form-control {{$errors->has('phone') ? 'is-invalid' :''}}" name="phone" value="{{ old('phone') }}" id="phone" placeholder="your phone">
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                                    
                <div class="form-group">
                    <label for="address">full address</label>
                    <textarea name="address" class="form-control {{$errors->has('address') ? 'is-invalid' :''}}" id="address" cols="30" rows="10">{{old('address')}}</textarea>
                    
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">pay</button>
            </form>
            


        
        </div>
    </div>


@endsection
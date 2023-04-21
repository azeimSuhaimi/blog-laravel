@extends('layouts.app')
 
@section('title', 'list order page')
 
@section('content')
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">list orders</h6>
        </div>
        <div class="card-body">
            
            <h5 class="card-title">list order</h5>

            <table id="table_id" class="display">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>name</th>
                      <th>email</th>
                      <th>reference</th>
                      <th>date</th>
                      <th>pack</th>
                      <th>#</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($orders as $order)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $order->name }}</td>
                          <td>{{ $order->email }}</td>
                          <td>{{ $order->reference }}</td>
                          <td>{{ $order->created_at }}</td>
                          <td>{{ $order->pack ? 'pack':'not pack' }}</td>
                          <td><a href="{{route('orders.show')}}?reference={{$order->reference}}" class="btn btn-primary">veiw order</a></td>
                          
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
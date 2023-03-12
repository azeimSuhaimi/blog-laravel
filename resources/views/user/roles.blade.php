@extends('layouts.app')
 
@section('title', 'roles page')
 

 
@section('content')

<div class="card">
    <h5 class="card-header">edit users role</h5>
    <div class="card-body">
      <h5 class="card-title">list users</h5>

      <table id="table_id" class="display">
        <thead>
            <tr>
                <th>#</th>
                <th>username</th>
                <th>role</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td><a href="{{route('user.show.roles')}}?username={{$user->username}}" class="btn btn-primary">edit role</a></td>
                    <td>{{ $user->created_at }}</td>
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
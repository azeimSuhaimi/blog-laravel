@extends('layouts.app')
 
@section('title', 'list messege page')
 
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">list messege</h6>
    </div>
    <div class="card-body">

        @include('partials.popup')
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>name</th>
                    <th>date</th>
                    <th>status</th>
                    <th>#</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($messege as $ms)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ms->name }}</td>
                        <td>{{ $ms->time }}</td>
                        <td>{{$ms->open == true ? 'read':'unread'}}</td>
                        <td><a class='btn btn-primary' href="{{route('view_messege')}}?id={{$ms->id }}">view</a></td>
                        
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
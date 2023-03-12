@extends('layouts.app')
 
@section('title', 'list posts page')
 
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
    </div>
    <div class="card-body">

        @include('partials.popup')
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>date</th>
                    <th>status</th>
                    <th>#</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td><a class="btn {{$post->active == true ? 'btn-success':'btn-danger'}}" href="{{$post->active == true ? route('deactive'):route('active')}}?id={{ $post->id }}">{{$post->active == true ? 'deactive post':'active post'}}</a></td>
                        <td><a class='btn btn-primary' href="{{route('editPost')}}?id={{$post->id }}">edit</a></td>
                        <td><a class="btn btn-info" href="{{route('viewPost')}}?id={{$post->id}} ">view post</a></td>
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

@extends('layouts.app')
 
@section('title', 'posts picker page')
 
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">posts picker</h6>
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
                        <td><a class="btn btn-info" href="{{route('viewPost')}}?id={{$post->id}} ">view post</a></td>
                        <form action="{{route('postsPicker.edit')}}" method="post">
                            @csrf
                        <td><div class="form-check">
                            
                            <input type="hidden" name="id" id="id" value="{{$post->id}}">
                            <input class="form-check-input" type="checkbox" name="c" id="c"  @checked(old('id', $post->pick))>
                            <label class="form-check-label" for="id">
                              Default checkbox
                            </label>
                          </div></td>
                          <td><button type="submit" class="btn btn-success">save</button></td>
                        </form>
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

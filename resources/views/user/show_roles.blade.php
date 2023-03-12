@extends('layouts.app')
 
@section('title', 'roles page')
 

 
@section('content')
<a href="{{route('user.roles')}}" class="btn btn-primary">back</a>

<div class="card">
    <h5 class="card-header">edit users role</h5>
    <div class="card-body">
      <h5 class="card-title">list permissions</h5>

        @include('partials.popup')


                <form action="{{route('user.edit.roles')}}" method="post">
                    @csrf
                    <p>username:{{ $user->username }}</p>

                    <p>name:{{ $user->name }}</p>
                    <p>email:{{ $user->email }}</p>
                    <p>role:{{ $user->role }}</p>
                    <input type="hidden" name="username" value="{{ $user->username }}">

                    <p>PERMISSIONS</p>
                    @foreach ($roles as $role)

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $role->access }}" name="role[]" {{ in_array($role->access, explode(',', $user->access)) ? 'checked' : '' }}>
                            <label class="form-check-label" >
                                {{ $role->permission }}
                            </label>
                        </div>
        
                    @endforeach

                    <button type="submit" class="btn btn-primary">edit</button>
                </form>




    </div>
  </div>

@endsection
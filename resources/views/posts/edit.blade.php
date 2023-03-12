@extends('layouts.app')
 
@section('title', 'edit posts page')
 
@section('content')
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> edit Posts</h6>
            </div>
            <div class="card-body">
                <a class="btn btn-success" href="#" onclick="window.history.back()">Go back</a>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <h5 class="card-header">edit users profile</h5>
                            <div class="card-body">
                                <h5 class="card-title">profile users</h5>

                                <img src="assets/posts_images/{{ $post->image }}" alt="..." class="img-thumbnail img-fluid rounded-circl">
                                
                                <form action="{{route('editPost.image')}}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $post->id }}">
                                        
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file" id="file-input" accept="image/*,.jpg,.jpeg,.png">
                                            <label class="custom-file-label"  for="file-input">Choose file</label>
                                            </div>
                                        </div>
                    
                                        
                    
                                        <button type="submit" class="btn btn-primary">edit</button>
                                </form>
        
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <h5 class="card-header">edit users profile</h5>
                            <div class="card-body">
                                <img id="image-preview" class="img-thumbnail img-fluid" src="no-image.jpg" alt="No image selected" style="display:none;">
                            </div>
                        </div>

                    </div>
                </div>

            

                @include('partials.popup')
              
                <form action="{{route('editPost.update')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $post->id }}">
                    <input type="hidden" name="title_unique" value="{{ $post->title }}">

                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' :''}}" name="title" value="{{ $post->title }}" id="title" placeholder="title">
                        @error('title')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Post category</label>
                        <select name="category" class="custom-select {{$errors->has('category') ? 'is-invalid' :''}}">
                            <option ></option>
                            <option value="finance" @selected($post->category == 'finance')>finance</option>
                            <option value="trending" @selected($post->category == 'trending')>trending</option>
                            <option value="politics" @selected($post->category == 'politics')>politics</option>
                            <option value="culture" @selected($post->category == 'culture')>culture</option>
                            <option value="business" @selected($post->category == 'business')>business</option>
                            <option value="biography" @selected($post->category == 'biography')>biography</option>
                            <option value="investment" @selected($post->category == 'investment')>investment</option>
                            <option value="tecnologies" @selected($post->category == 'tecnologies')>tecnologies</option>
                        </select>
                        @error('category')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="tiny">content</label>
                        <textarea name="content" class="form-control {{$errors->has('content') ? 'is-invalid' :''}}" id="tiny" rows="3">{{ $post->content }}</textarea>
                        @error('content')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">posts</button>
                </form>
            </div>
        </div>
        



        <script>
        tinymce.init({
            selector: 'textarea#tiny',
                plugins: [
                'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
                'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
                'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
                ],
                toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +
                'bullist numlist checklist outdent indent | removeformat | code table help'
        })
        </script>

<script>
    const fileInput = document.getElementById('file-input');
    const imagePreview = document.getElementById('image-preview');
    
    fileInput.addEventListener('change', function () {
      const file = fileInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function () {
          imagePreview.src = reader.result;
          imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        imagePreview.style.display = 'none';
      }
    });
    console.log(fileInput);

    
    
    
    </script>
@endsection
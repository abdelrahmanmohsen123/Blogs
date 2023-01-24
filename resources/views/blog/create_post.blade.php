@extends('layouts.app')
@section('title','create post')
@section('content')
    <div class="container">
        <div class="row my-5">
            <h2>Create Post</h2>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row ">
            <div class="card p-3">
                <form class="row g-3 needs-validation" action="{{ route('post.store') }}" method="post" enctype="multipart/form-data" novalidate>
                  @csrf  
                  <div class="col-md-6">
                      <label for="validationCustom01" class="form-label">Title</label>
                      <input type="text" class="form-control" id="validationCustom01" name="title" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="validationCustom01" class="form-label">Author</label>
                      <input type="text" class="form-control" id="validationCustom01" name="author" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="validationCustom01" class="form-label">Content</label>
                      <textarea name="content" class="form-control"  id="validationCustom01" cols="5" rows="3">

                      </textarea>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="formFile" class="form-label">Default file input example</label>
                      <input class="form-control" type="file" name="image" id="formFile">
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="date" class="form-label">Date</label>
                      <input class="form-control" type="date" name="date" id="date">
                    </div>
                    <div class="col-12 text-center">
                      <button class="btn btn-primary" name="submit" type="submit">Add Post</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>


    {{-- ///js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    

@endsection
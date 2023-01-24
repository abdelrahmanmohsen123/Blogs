@extends('layouts.app')

@section('title','Create comment')
@section('content')
    <div class="container">
        <div class="row my-5">
            <h2>Create comment</h2>
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
                <form class="row g-3 needs-validation" action="{{ route('comment.store') }}" method="post" novalidate>
                  @csrf  
                  <div class="col-md-6">
                      <label for="validationCustom01" class="form-label">Posts</label>
                      <select class="form-select" name="post_id" aria-label="Default select example">

                        <option selected disabled>Open this select menu</option>
                        @foreach ($posts as $post )
                          <option value="{{ $post->id }}">{{ $post->title }}</option>

                        @endforeach
                    
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="validationCustom01" class="form-label">Users</label>
                      <select class="form-select" name="user_id" aria-label="Default select example">
                        <option selected disabled>Open this select menu</option>
                        @foreach ($users as $user )
                          <option value="{{ $user->id }}">{{ $user->name }}</option>

                        @endforeach
                       
                      </select>
                    </div>
                    
                    <div class="col-md-12">
                      <label for="validationCustom01" class="form-label">Content</label>
                      <textarea name="content" class="form-control"   id="validationCustom01" cols="5" rows="3">

                      </textarea>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                    <div class="mb-3 col-md-12">
                      <label for="date" class="form-label">Date</label>
                      <input class="form-control" name="date" type="date" id="date">
                    </div>
                    <div class="col-12 text-center">
                      <button class="btn btn-primary" name="submit" type="submit">Add comment</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>


    {{-- ///js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    {{-- <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script> --}}
@endsection
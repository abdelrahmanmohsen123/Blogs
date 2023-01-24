@extends('layouts.app')
@section('title','All posts')
@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-6">
                <h2>
                    All posts
                </h2>
            </div>
            <div class="col-6">
                <a href="{{ route('post.create') }}" class="btn btn-primary">Add post</a>
            </div>
           
        </div>
        @if(session()->has('status'))
            <div class="alert alert-success text-center">
                {{ session()->get('status') }}
            </div>
        @endif
        @if(session()->has('failed'))
            <div class="alert alert-danger text-center">
                {{ session()->get('failed') }}
            </div>
        @endif
        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">author</th>
                    <th scope="col">content</th>
                    <th scope="col">image</th>
                    <th scope="col">date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td >{{ $post->title }}</td>
                        <td>{{ $post->author }}</td>
                        <td>{{ $post->content }}</td>
                        <td >
                            <img src="{{asset('images/'.$post->image)}}" width="120px" alt="">
                        </td>
                        <td>{{ $post->date }}</td>
                        <td class="row align-item-center"> 
                            <div class="col">
                                <a href="{{ route('post.edit',$post->id) }}" class="btn btn-secondary"> edit</a>

                            </div>
                            <div class="col">
                                <form action="{{ route('post.delete',$post->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"  class="btn btn-danger"> delete</a>
                                </form>
                            </div>
                           
                            
                        </td>
                      </tr>
                @empty
                    <p>No posts</p>
                @endforelse
                 
                </tbody>
              </table>
        </div>
    </div>
    
@endsection
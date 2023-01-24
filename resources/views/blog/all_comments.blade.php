@extends('layouts.app')
@section('title','All comments')
@section('content')
<div class="container">
    <div class="row my-4">
        <div class="col-6">
            <h2>
                All comments
            </h2>
        </div>
        <div class="col-6">
            <a href="{{ route('comment.create') }}" class="btn btn-primary">Add comment</a>
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
                <th scope="col">user</th>
                <th scope="col">post</th>
                <th scope="col">content</th>
                <th scope="col">date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($comments as $comment)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td >{{ $comment->user->name }}</td>
                    <td>{{ $comment->post->title }}</td>
                    <td>{{ $comment->comment }}</td>
                    <td>{{ $comment->date }}</td>
                    <td class="row align-item-center"> 
                        <div class="col">
                            <a href="{{ route('comment.edit',$comment->id) }}" class="btn btn-secondary"> edit</a>

                        </div>
                        <div class="col">
                            <form action="{{ route('comment.delete',$comment->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit"  class="btn btn-danger"> delete</a>
                            </form>
                        </div>
                       
                        
                    </td>
                  </tr>
            @empty
                <p>No comments</p>
            @endforelse
             
            </tbody>
          </table>
    </div>
</div>
@endsection



@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header h3 text-center">List of Your Post</div>

                <h5 class="card-header">
                    <a class="btn btn-outline-primary" href="{{ route('todo.create')}}"> ➕ Add Post</a>
                </h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session()->has('success'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    <table class="table table-hover table-borderless">
                        <thead>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created AT</th>
                            <th scope="col">isCompleted?</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                            <tr>
                                @if($post->completed)
                                    <td><a class="text-success text-decoration-none" href="{{route('todo.edit',$post->id)}}">{{$post->title}}</a></td>
                                    <td>{{$post->description}}</td>
                                    <td>{{$post->created_at}}</td>
                                    <td class="text-success fw-bold" >Yes</td>

                                @else
                                    <td><a class="text-dark text-decoration-none" href="{{route('todo.edit',$post->id)}}">{{$post->title}}</a></td>
                                    <td>{{$post->description}}</td>
                                    <td>{{$post->created_at}}</td>
                                    <td class="text-danger fw-bold" >No</td>
                                @endif
                                <td>
                                    <a href="{{route('todo.edit',$post->id)}}" class="btn btn-outline-success">🖊 Edit</a>
                                    <a href="{{route('todo.show',$post->id)}}" class="btn btn-outline-danger">❌ Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>No post is created</td>
                            </tr>
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

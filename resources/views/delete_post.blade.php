@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Delete {{$post->title}}</div>

                <h5 class="card-header">
                    <a class="btn btn-outline-primary" href="{{ route('todo.index')}}"> ⬅ Go Back</a>
                </h5>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('todo.destroy',$post->id) }}">
                        @csrf
                        @method('DELETE')

                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <h3 class="text-center">Are you sure you want to delete the Post entitled "{{$post->title}}"</h3>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="d-flex justify-content-center gap-3">
                                <button type="submit" class="btn btn-danger col-2">
                                    Yes
                                </button>
                                <a class="btn btn-primary col-2" href="{{route('todo.index')}}">No</a>
                            </div>
                        </div>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

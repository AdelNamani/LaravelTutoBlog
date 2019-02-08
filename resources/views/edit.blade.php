@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Create a new post</h2>
                <form method="POST" action="{{route('posts.update',['id'=>$post->id])}}">
                    @csrf

                    {{ method_field('patch') }}

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" id="title" name="title" value="{{$post->title}}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="10" class="form-control" id="description" name="description">{{$post->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-outline-success float-right" type="submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
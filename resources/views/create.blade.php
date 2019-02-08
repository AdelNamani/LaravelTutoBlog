@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('css/myStyle.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Create a new post</h2>
            <form method="POST" action="{{route('posts.store')}}">
                @csrf
                <div class="form-group @if ($errors->has('title')) has-error @endif">
                    <label for="title">Title</label>
                    <input class="form-control" id="title" name="title" placeholder="The title of your post here ...">
                    @foreach ($errors->get('title') as $message)
                        <span class="help-block" > {{$message}} </span>
                    @endforeach
                </div>

                <div class="form-group @if ($errors->has('description')) has-error @endif">
                    <label for="description">Description</label>
                    <textarea rows="10" class="form-control" id="description" name="description" placeholder="Your post here ..."></textarea>
                    @foreach ($errors->get('description') as $message)
                        <span class="help-block" > {{$message}} </span>
                    @endforeach
                </div>


                <div class="form-group">
                    <button class="btn btn-outline-success float-right" type="submit">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
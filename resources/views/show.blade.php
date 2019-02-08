@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>{{$post->title}}</h2>
                <span class="small float-left">Written by : {{$author->name}}</span>
                <span class="small float-right">
                @if ((Auth::check())&&(Auth::user()->id==$author->id))

                    <a href="{{route('posts.edit',['id'=>$post->id])}}" class="btn btn-link btn-sm" >Edit</a>

                    <form method="POST" action="{{route('posts.destroy',['id'=>$post->id])}}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link btn-sm">Delete</button>
                    </form>

                @endif
                </span>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-8" style="text-indent: 50px">
                {{$post->description}}
            </div>
        </div>
    </div>
@endsection
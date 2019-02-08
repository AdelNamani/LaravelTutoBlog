@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Learn more</th>
                        <th>Created on</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(sizeof($posts))
                        @foreach($posts as $post)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->name }}</td>
                                <td>
                                    <a href="{{route('posts.show',['id'=>$post->id])}}">Read post</a>
                                </td>
                                <td>{{ Carbon\Carbon::parse($post->created_at)->format('d-m-Y')  }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5"><p class="text-center text-primary">No Posts created Yet!</p></td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                <div class="row justify-content-center">
                    {{ $posts->links() }}
                </div>
                <div class="row justify-content-center">
                    <a href="{{route('posts.create')}}" class="btn btn-outline-info w-50 ">Create a new post</a>
                </div>
            </div>
        </div>
    </div>
@endsection

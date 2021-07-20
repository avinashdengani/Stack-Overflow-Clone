@extends('layouts.app')
@section('title', 'Favorite Questions | Stack Overflow Clone')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('questions.create') }}" class="btn btn-outline-primary">Ask Question</a>
            </div>
            <div class="card">
                <div class="card-header"><h1>Favorite Questions</h1></div>
                @foreach ($favoriteQuestions as $question)
                <div class="card-body">
                    <div class="media">
                        <div class="mr-4 statistics">
                            <div class="votes text-center mb-3">
                                <strong class="d-block">{{ $question->votes_count }}</strong>
                                {{Str::plural('Vote', $question->votes_count)}}
                            </div>
                            <a href="{{$question->url}}" class="nav-link">
                                <div class="text-center mb-3 answers {{ $question->answer_style }}">
                                        <strong class="d-block">{{ $question->answers_count }}</strong>
                                        {{Str::plural('Answer', $question->answers_count)}}
                                </div>
                            </a>
                            <div class="views text-center">
                                <strong class="d-block">{{ $question->views_count }}</strong>
                                {{Str::plural('View', $question->views_count)}}
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="d-flex justify-content-between">
                                <h4><a href="{{ asset($question->url) }}">{{ $question->title }}</a></h4>
                                <div>
                                    @can('update', $question)
                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">
                                            Edit
                                        </a>
                                    @endcan
                                    @can('delete', $question)
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete')">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                            <p>
                                Asked By: <a href="#">{{$question->owner->name}} </a>
                                <span class="text-muted"> {{$question->created_date}}</span>
                            </p>
                            <p>{!! \Illuminate\Support\Str::limit($question->body, 255) !!}</p>
                            @can('markAsFavorite', $question)
                                        <form method="POST"
                                            action="{{route('questions.unfavorite', $question->id)}}" class="m-0">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                    class="btn p-0 text-golden"
                                                    title="Mark as unfavorite">
                                                <i class="fa fa-star fa-2x text-golden" ></i>
                                            </button>
                                        </form>
                                    @else
                                        <i class="fa fa-star-o fa-2x text-golden d-block" ></i>
                                    @endcan
                                    <h4 class=" ml-2  mt-1 text-golden
                                    ">{{$question->favorites_count}}</h4>
                        </div>
                    </div>
                </div>
                {!! !($loop->last) ? '<hr>': '' !!}
                @endforeach
                <div class="card-footer">
                    {{ $favoriteQuestions->appends(['search' => request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

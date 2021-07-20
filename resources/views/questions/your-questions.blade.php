@extends('layouts.app')
@section('title', 'Questions | Stack Overflow Clone')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('questions.create') }}" class="btn btn-outline-primary">Ask Question</a>
            </div>
            <div class="card">
                <div class="card-header"><h1>Your Questions</h1></div>
                @foreach ($questions as $question)
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
                                <h4><a href="{{ $question->url }}">{{ $question->title }}</a></h4>
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
                        </div>
                    </div>
                </div>
                {!! !($loop->last) ? '<hr>': '' !!}
                @endforeach
                <div class="card-footer">
                    {{ $questions->appends(['search' => request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

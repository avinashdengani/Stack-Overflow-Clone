@extends('layouts.app')
@section('title', 'Questions | Stack Overflow Clone')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{route('questions.create')}}" class="btn btn-outline-primary">Ask Question</a>
                </div>
                <div class="card">
                    <div class="card-header"><h2>All Questions</h2></div>
                    @foreach ($questions as $question)
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="mr-4 statistics">
                                    <div class="votes text-center mb-3">
                                        <strong class="d-block">{{ $question->votes_count }}</strong>
                                    Votes</div>
                                    <div class="answers text-center mb-3 {{ $question->answer_style }}">
                                        <strong class="d-block">{{ $question->answers_count }}</strong>
                                    Answers</div>
                                    <div class="views text-center mb-3">
                                        <strong class="d-block">{{ $question->views_count }}</strong>
                                    Views</div>
                                </div>
                                <div class="media-body">
                                    <h4><a href="{{ $question->url }}" class="card-title">{{ $question->title }}</a></h4>
                                    <p class="card-text">
                                        Asked by: <a href="#">{{ $question->owner->name }}</a>
                                        <span class="text-muted" > {{ $question->created_date }}</span>
                                    </p>
                                    <p>{!! Str::limit($question->body, 255) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="card-footer">
                        {{$questions->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

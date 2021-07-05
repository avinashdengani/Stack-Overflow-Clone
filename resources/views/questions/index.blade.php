@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Questions</div>
                    @foreach ($questions as $question)
                        <div class="card-body">
                            <div class="media">
                                <div class="mr-4 statistics">
                                    <div class="votes text-center mb-3">Votes
                                        <strong class="d-block">{{ $question->votes_count }}</strong>
                                    </div>
                                    <div class="answers text-center mb-3 {{ $question->answer_style }}">Answers
                                        <strong class="d-block">{{ $question->answers_count }}</strong>
                                    </div>
                                    <div class="views text-center mb-3">Views
                                        <strong class="d-block">{{ $question->views_count }}</strong>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4><a href="{{ $question->url }}">{{ $question->title }}</a></h4>
                                    <p>
                                        Asked by: <a href="#">{{ $question->owner->name }}</a>
                                        <span class="text-muted" > {{ $question->created_date }}</span>
                                    </p>
                                    <p>{{ Str::limit($question->body, 255) }}</p>
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

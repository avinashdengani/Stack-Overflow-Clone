@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex mb-2 justify-content-between">
                    <a href="{{ route('questions.index') }}" class="btn btn-outline-primary"><i class="fa phpdebugbar-fa-chevron-circle-left" ></i> Back to Questions</a>
                    <a href="@auth #your-answer @else {{ route('login') }}@endauth" class="btn btn-outline-primary">Answer Now</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex flex-column">
                            <div class="d-block">
                                <h1 class="d-inline">{{ $question->title }}</h1>
                                <p class="text-muted float-right">Asked {{$question->created_date}}</p>
                            </div>
                            <div class="d-block">
                                <div class="float-left mt-1">
                                    <div class="d-flex">
                                        <p class="text-muted"><i class="fa phpdebugbar-fa-eye fa-2x"></i></p>
                                        <h4 class="mt-1 ml-1 text-muted">{{$question->views_count}}</h4>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <img src="{{$question->owner->avatar}}" alt="user-avatar">
                                    </div>
                                    <div class="ml-2 mt-1">
                                        <p>{{$question->owner->name}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="action-buttons mr-3">
                                <div>
                                    @auth
                                        <form action="{{route('questions.vote', [$question->id, 1])}}" method="POST" class="mb-0">
                                            @csrf
                                            <button type="submit"
                                                    class="btn p-0 {{ auth()->user()->hasQuestionUpVote($question) ? 'text-dark' : 'text-black-50' }}"
                                                    title="Up Vote">
                                                <i class="fa fa-caret-up fa-3x" ></i>
                                            </button>
                                        </form>
                                    @else
                                    <a href="{{route('login')}}" title="Up Vote" class="d-block text-center text-black-50"><i class="fa fa-caret-up fa-3x" ></i></a>
                                    @endauth
                                    <div class="d-block">
                                        <h4 class="votes-count-text text-muted @auth @if ($question->votes_count < 0 || $question->votes_count > 9) m-0 text-center @endif @endauth">{{$question->votes_count}}</h4>
                                    </div>
                                    @auth
                                        <form action="{{route('questions.vote', [$question->id, -1])}}" method="POST" class="mb-0">
                                            @csrf
                                            <button type="submit"
                                                    class="btn p-0 {{ auth()->user()->hasQuestionDownVote($question) ? 'text-dark' : 'text-black-50' }}"
                                                    title="Down Vote">
                                                <i class="fa fa-caret-down fa-3x" ></i>
                                            </button>
                                        </form>
                                    @else
                                    <a href="{{route('login')}}" title="Down Vote" class="d-block text-center text-black-50"><i class="fa fa-caret-down fa-3x" ></i></a>
                                    @endauth
                                </div>
                                <div class="m-0">
                                    @can('markAsFavorite', $question)
                                        <form method="POST"
                                            action="{{route($question->is_favorite ? 'questions.unfavorite' : 'questions.favorite', $question->id)}}" class="m-0">
                                            @csrf
                                            @if ($question->is_favorite)
                                                @method('DELETE')
                                            @endif
                                            <button type="submit"
                                                    class="btn p-0 {{$question->favorite_style}}"
                                                    title="{{$question->is_favorite ? 'Mark as unfavorite' : 'Mark as favorite'}}">
                                                <i class="fa fa-star fa-2x {{$question->favorite_style}}" ></i>
                                            </button>
                                        </form>
                                    @else
                                        <i class="fa fa-star-o fa-2x text-golden d-block" ></i>
                                    @endcan
                                    <h4 class="text-center mt-1 {{$question->favorite_style}}">{{$question->favorites_count}}</h4>
                                </div>
                            </div>
                            <div class="question-body">
                                {!! $question->body !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @include('answers._index')
    <div id="your-answer">
        @include('answers._create')
    </div>
    </div>
@endsection

@section('styles')
    <style>
        .text-golden{
            color: goldenrod;
        }
        .votes-count-text {
            margin: 0 0 0 .45rem;
        }
    </style>

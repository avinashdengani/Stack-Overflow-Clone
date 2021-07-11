@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1>{{ $question->title }}</h1></div>
                    <div class="card-body">
                        {!! $question->body !!}
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between mr-3">
                            <div class="d-flex">
                                <div>
                                    <a href="" title="Up Vote" class="vote-up d-block text-center text-black-50"><i class="fa fa-caret-up fa-3x" ></i></a>
                                    <h4 class="votes-count text-muted text-center m-0">45</h4>
                                    <a href="" title="Down Vote" class="vote-down d-block text-center text-black-50"><i class="fa fa-caret-down fa-3x" ></i></a>
                                </div>
                                <div class="ml-5 mt-3">
                                    @can('markAsFavorite', $question)
                                        <form method="POST"
                                            action="{{route($question->is_favorite ? 'questions.unfavorite' : 'questions.favorite', $question->id)}}">
                                            @csrf
                                            @if ($question->is_favorite)
                                                @method('DELETE')
                                            @endif
                                            <button type="submit" class="btn {{$question->favorite_style}}"><i class="fa fa-star fa-2x {{$question->favorite_style}}" ></i></button>
                                        </form>
                                    @else
                                        <i class="fa fa-star-o fa-2x text-golden d-block" ></i>
                                    @endcan
                                    <h4 class="text-center m-0 {{$question->favorite_style}}">{{$question->favorites_count}}</h4>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="text-muted mb-3 text-right">
                                    <p>Asked {{$question->created_date}}</p>
                                </div>
                                <div class="d-flex mb-2">
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
                </div>
            </div>
        </div>

    @include('answers._index')
    @include('answers._create')
    </div>
@endsection

@section('styles')
    <style>
        .text-golden{
            color: goldenrod;
        }
    </style>

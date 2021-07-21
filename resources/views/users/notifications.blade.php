@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Notifications</h1>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($notifications as $notification )
                                @if ($notification->type === \App\Notifications\NewReplyAdded::class)
                                    <li class="list-group-item">
                                        Someone has answered to your question. <strong>{{$notification->data['question']['title']}}</strong>
                                        <a href="{{route('questions.show', $notification->data['question']['slug'])}}" class="btn btn-sm btn-info text-white float-right">
                                        View Question
                                        </a>
                                    </li>
                                @endif
                                @if ($notification->type === \App\Notifications\NewFavoriteMarked::class)
                                    <li class="list-group-item">
                                        Someone has marked your question as favorite. <strong>{{$notification->data['question']['title']}}</strong>
                                            <a href="{{route('questions.show', $notification->data['question']['slug'])}}" class="btn btn-sm btn-info text-white float-right">
                                            View Question
                                            </a>
                                    </li>
                                @endif
                                @if ($notification->type === \App\Notifications\MarkedAsBestAnswer::class)
                                    <li class="list-group-item">
                                        Congratulations your answer has been marked as Best Answer. <strong class="d-inline">{!! Str::limit($notification->data['answer']['body'], 20) !!}</strong>
                                            <a href="{{route('questions.show', $notification->data['question']['slug'])}}" class="btn btn-sm btn-info text-white float-right">
                                            View Question
                                            </a>
                                    </li>
                                @endif
                                @if ($notification->type === \App\Notifications\UnmarkedAsBestAnswer::class)
                                    <li class="list-group-item">
                                        Sorry! your answer has been unmarked from Best Answer. <strong class="d-inline">{!! Str::limit($notification->data['answer']['body'], 20) !!}</strong>
                                            <a href="{{route('questions.show', $notification->data['question']['slug'])}}" class="btn btn-sm btn-info text-white float-right">
                                            View Question
                                            </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

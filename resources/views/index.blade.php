@extends('layouts.app')
@section('title', 'Stack Overflow Clone')
@section('content')

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <ul class="nav flex-column">
                        <li class="nav-item my-bottom-border">
                            <a href="{{route('questions.index')}}" class="nav-link font-weight-bold font-size-25 {{request()->is('questions') ? 'text-dark': ''}}">All Questions <i class="fa fa-question-circle"></i></a>
                        </li>
                        @auth
                            <li class="nav-item my-bottom-border">
                                <a href="{{route('questions.your-questions')}}" class="nav-link font-weight-bold font-size-25 {{request()->is('questions') ? 'text-dark': ''}}">Your Questions <i class="fa fa-user-o"></i></a>
                            </li>
                            <li class="nav-item my-bottom-border">
                                <a href="{{route('questions.favorites')}}" class="nav-link font-weight-bold font-size-25 {{request()->is('questions') ? 'text-dark': ''}}">Favorites <i class="fa fa-star text-golden"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.notifications')}}" class="nav-link font-weight-bold font-size-25 {{request()->is('users/notifications') ? 'text-dark': ''}}">Notifications <i class="fa fa-bell-o {{auth()->user()->unreadNotifications()->count() > 0 ? 'text-danger' : ''}}"></i>({{auth()->user()->unreadNotifications()->count()}})</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('questions.create') }}" class="btn btn-outline-primary mt-1">Ask Question</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1>Dashboard</h1>
                </div>
                <div class="card-body">
                    @auth
                    <li class="list-group-item">
                        You have asked <a href="{{route('questions.your-questions')}}" class="nav-link d-inline p-0 m-0">{{$your_questions->count()}} {{Str::plural('Question', $your_questions->count())}}</a>.
                    </li>
                    @else
                    <li class="list-group-item">
                        Your are not logged in. <a href="{{route('login')}}">Login now</a> to <a href="{{route('questions.create')}}">ASK</a> and ANSWER the <a href="{{route('questions.index')}}">questions</a>.
                    </li>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<div class="row justify-content-center mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="mt-0" >{{Str::plural('Answer', $question->answers_count)}}</h3>
            </div>
            <div class="card-body">
                @foreach ($question->answers as $answer)
                    {!! $answer->body !!}
                    <div class="d-flex justify-content-between mr-3">
                        <div class="d-flex">
                            <div>
                                @auth
                                    <form action="{{route('answers.vote', [$answer->id, 1])}}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="btn {{ auth()->user()->hasAnswerUpVote($answer) ? 'text-dark' : 'text-black-50' }}"
                                                title="Up Vote">
                                            <i class="fa fa-caret-up fa-3x" ></i>
                                        </button>
                                    </form>
                                @else
                                <a href="{{route('login')}}" title="Up Vote" class="d-block text-center text-black-50"><i class="fa fa-caret-up fa-3x" ></i></a>
                                @endauth
                                <h4 class="votes-count text-muted text-center m-0">{{$answer->votes_count}}</h4>
                                @auth
                                    <form action="{{route('answers.vote', [$answer->id, -1])}}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="btn {{ auth()->user()->hasAnswerDownVote($answer) ? 'text-dark' : 'text-black-50' }}"
                                                title="Down Vote">
                                            <i class="fa fa-caret-down fa-3x" ></i>
                                        </button>
                                    </form>
                                @else
                                <a href="{{route('login')}}" title="Down Vote" class="d-block text-center text-black-50"><i class="fa fa-caret-down fa-3x" ></i></a>
                                @endauth
                            </div>
                            <div class="ml-5 mt-3">
                                @can('markAsBest', $answer)
                                    <form action="{{route('answers.bestAnswer', $answer->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" title="Mark as Best answer" class="btn {{$answer->best_answer_style}}"><i class="fa fa-check fa-2x" ></i></button>
                                    </form>
                                @else
                                    @if ($answer->is_best_answer)
                                        <i class="fa fa-check fa-2x text-success d-block mb-2"></i>
                                    @endif
                                @endcan
                                <h4 class="views-count text-muted text-center m-0">123</h4>
                            </div>

                            @can('update', $answer)
                                <div class="d-inline ml-5">
                                    <a href="{{route('questions.answers.edit', [$question->id, $answer->id])}}" class="btn btn-sm btn-outline-info">Edit</a>
                                </div>
                            @endcan

                            @can('delete', $answer)
                                <form action="{{route('questions.answers.destroy', [$question->id, $answer->id])}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                </form>
                            @endcan
                        </div>
                        <div class="d-flex flex-column">
                            <div class="text-muted mb-3 text-right">
                                <p>Answered {{$answer->created_date}}</p>
                            </div>
                            <div class="d-flex ">
                                <div>
                                    <img src="{{$answer->author->avatar}}" alt="user-avatar">
                                </div>
                                <div class=" ml-2 mt-1">
                                    <p>{{$answer->author->name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>

</div>

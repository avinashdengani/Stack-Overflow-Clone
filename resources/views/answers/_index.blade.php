<div class="row justify-content-center mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if ($question->answers_count > 0)
                    <h3 class="mt-0" >{{Str::plural('Answer', $question->answers_count)}}</h3>
                @else
                    <p><h3 class="text-danger">No answers yet :( </h3>  </p>
                    <p><h3 class="text-success">Be <b><i>first</i></b> to answer</h3></p>
                @endif
            </div>
            <div class="card-body">
                @foreach ($question->answers as $answer)
                    <div class="d-flex">
                        <div class="action-buttons mr-3">
                            <div>
                                @auth
                                    <form action="{{route('answers.vote', [$answer->id, 1])}}" method="POST" class="mb-0">
                                        @csrf
                                        <button type="submit"
                                                class="btn p-0 {{ auth()->user()->hasAnswerUpVote($answer) ? 'text-dark' : 'text-black-50' }}"
                                                title="Up Vote">
                                            <i class="fa fa-caret-up fa-3x" ></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{route('login')}}" title="Up Vote" class="d-block text-center text-black-50"><i class="fa fa-caret-up fa-3x" ></i></a>
                                @endauth
                                <div class="d-block">
                                    <h4 class="votes-count-text text-muted m-0 text-center">{{$answer->votes_count}}</h4>
                                </div>
                                @auth
                                    <form action="{{route('answers.vote', [$answer->id, -1])}}" method="POST" class="mb-0">
                                        @csrf
                                        <button type="submit"
                                                class="btn p-0 {{ auth()->user()->hasAnswerDownVote($answer) ? 'text-dark' : 'text-black-50' }}"
                                                title="Down Vote">
                                            <i class="fa fa-caret-down fa-3x" ></i>
                                        </button>
                                    </form>
                                @else
                                <a href="{{route('login')}}" title="Down Vote" class="d-block text-center text-black-50"><i class="fa fa-caret-down fa-3x" ></i></a>
                                @endauth

                                @can('markAsBest', $answer)
                                    <form action="{{route('answers.bestAnswer', $answer->id)}}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" title="Mark as Best answer" class="btn p-0  {{$answer->best_answer_style}}"><i class="fa fa-check fa-2x" ></i></button>
                                    </form>
                                @else
                                    @if ($answer->is_best_answer)
                                        <i class="fa fa-check fa-2x text-success d-block  mt-3 mb-2"></i>
                                    @endif
                                @endcan

                                @can('update', $answer)
                                    <div class="d-block  mt-3">
                                        <a
                                            href="{{route('questions.answers.edit', [$question->id, $answer->id])}}"
                                            class="btn btn-sm btn-outline-info"
                                            title="Edit your answer">
                                                <i class="fa fa-edit fa-2x" ></i>
                                        </a>
                                    </div>
                                @endcan
                                @can('delete', $answer)
                                    <form action="{{route('questions.answers.destroy', [$question->id, $answer->id])}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger mt-3 "
                                            onclick="return confirm('Are you sure you want to delete?')"
                                            title="Delete your answer">
                                                <i class="fa fa-trash fa-2x" ></i>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        <div class="answer-body">
                            {!! $answer->body !!}
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-block">
                            <p class="text-muted float-right">Answered {{$answer->created_date}}</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div>
                                <img src="{{$answer->author->avatar}}" alt="user-avatar">
                            </div>
                            <div class="ml-2 mt-1">
                                <p>{{$answer->author->name}}</p>
                            </div>
                        </div>
                    </div>

                    {!! !($loop->last) ? '<hr>': '' !!}
                @endforeach
            </div>
        </div>
    </div>

</div>

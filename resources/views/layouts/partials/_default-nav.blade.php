<!-- Search
    ===================================== -->
    <div class="pr25 pl25 clearfix">
        <form action="#">
            <div class="form-search">
                <form action="{{asset('/')}}">
                    <input type="text"
                        name="search"
                        placeholder="e.g. Javascript"
                        value="{{request('search')}}">
                    <button type="submit" class="pull-right">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </form>
    </div>
    @if (!(request()->is('/')))
        <li class="nav-item default-nav">
            <a
                href="{{route('index')}}"
                class="btn m-1 {{request()->is('/') ? 'btn-primary text-white' : 'btn-info'}}">
                    Dashboard
            </a>
        </li>
        <li class="nav-item default-nav">
            <a
                href="{{route('questions.index')}}"
                class="btn m-1 {{request()->is('questions') ? 'btn-primary text-white' : 'btn-info'}}">
                    All Questions
                    <i class="fa fa-question-circle"></i>
            </a>
        </li>
        @auth
            <li class="nav-item default-nav">
                <a
                    href="{{route('questions.your-questions')}}"
                    class="btn m-1 {{request()->is('questions/your-questions') ? 'btn-primary text-white' : 'btn-info'}}">
                    Your Questions
                </a>
            </li>
            <li class="nav-item default-nav">
                <a
                    href="{{route('questions.favorites')}}"
                    class="btn m-1 {{request()->is('questions/favorites') ? 'btn-primary text-white' : 'btn-info'}}">Favorites <i class="fa fa-star text-golden"></i></a>
            </li>
            <li class="nav-item default-nav">
                <a href="{{route('users.notifications')}}" class="btn m-1 {{request()->is('users/notifications') ? 'btn-primary text-white' : 'btn-info'}}">Notifications <i class="fa fa-bell-o {{auth()->user()->unreadNotifications()->count() > 0 ? 'text-danger' : ''}}"></i>({{auth()->user()->unreadNotifications()->count()}})</a>
            </li>
        @endauth
    @endif

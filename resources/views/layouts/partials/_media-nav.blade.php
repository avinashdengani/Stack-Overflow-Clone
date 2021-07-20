@if (!(request()->is('/')))
    <li class="nav-item  media-nav">
        <a
            href="{{route('index')}}"
            class="btn m-1 {{request()->is('/') ? 'btn-primary text-white' : 'btn-info'}}"
            title="Dashboard">
                <i class="fa fa-dashboard" ></i>
        </a>
    </li>
    <li class="nav-item  media-nav">
        <a
            href="{{route('questions.index')}}"
            class="btn m-1 {{request()->is('questions') ? 'btn-primary text-white' : 'btn-info'}}"
            title="All Questions">
                <i class="fa fa-question-circle"></i>
        </a>
    </li>
    @auth
        <li class="nav-item  media-nav">
            <a
                href="{{route('questions.your-questions')}}"
                class="btn m-1 {{request()->is('questions/your-questions') ? 'btn-primary text-white' : 'btn-info'}}"
                title="Your Questions">
                    <i class="fa fa-users" ></i>
                    <i class="fa fa-question" ></i>
            </a>
        </li>
        <li class="nav-item  media-nav">
            <a
                href="{{route('questions.favorites')}}"
                class="btn m-1 {{request()->is('questions/favorites') ? 'btn-primary text-white' : 'btn-info'}}"
                title="Favorites">
                    <i class="fa fa-star text-golden"></i></a>
        </li>
        <li class="nav-item  media-nav">
            <a
                href="{{route('users.notifications')}}"
                class="btn m-1 {{request()->is('users/notifications') ? 'btn-primary text-white' : 'btn-info'}}"
                title="Notifications">
                    <i
                        class="fa fa-bell-o {{auth()->user()->unreadNotifications()->count() > 0 ? 'text-danger' : ''}}">
                    </i>
                        ({{auth()->user()->unreadNotifications()->count()}})
            </a>
        </li>
    @endauth

@endif

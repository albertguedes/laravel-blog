<div class="row justify-content-center h5" >

    <div class="col-3" >
        <div class="mb-3" >
            <a class="text-decoration-none text-secondary" href="{{ route('home') }}" ><i class="fas fa-home"></i> Home</a>
        </div>
        <div class="mb-3" >
            <a class="text-decoration-none text-secondary" href="{{ route('about') }}" ><i class="fas fa-info-circle"></i> About</a>
        </div>
        <div class="mb-3" >
            <a class="text-decoration-none text-secondary" href="{{ route('contact') }}" ><i class="fas fa-envelope"></i> Contact</a>
        </div>
    </div>

    <div class="col-3" >
        <div class="mb-3" >
            <a class="text-decoration-none text-secondary" href="{{ route('search') }}" ><i class="fas fa-search"></i> Search</a>
        </div>
        <div class="mb-3" >
            <a class="text-decoration-none text-secondary" href="{{ route('chat') }}" ><i class="fas fa-comments"></i> Chat</a>
        </div>
        <div class="mb-3" >
            <a class="text-decoration-none text-secondary" href="{{ route('archive') }}" ><i class="fas fa-archive"></i> Archive</a>
        </div>
    </div>

    <div class="col-3" >
        <div class="mb-3" >
            <a class="text-decoration-none text-secondary" href="{{ route('authors') }}" ><i class="fas fa-users"></i> Authors</a>
        </div>
        <div class="mb-3" >
            <a class="text-decoration-none text-secondary" href="{{ route('categories') }}" ><i class="fas fa-sitemap"></i> Categories</a>
        </div>
        <div class="mb-3" >
            <a class="text-decoration-none text-secondary" href="{{ route('tags') }}" ><i class="fas fa-tag"></i> Tags</a>
        </div>
    </div>

    <div class="col-3" >
        <ul class="nav flex-column" >
            @auth
            <li class="nav-item" >
                <a class="nav-link text-decoration-none" href="{{ route('profile') }}" >
                    <i class="fas fa-user-circle"></i> Profile
                </a>
            </li>
            <li class="nav-item" >
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="text-white nav-link btn btn-danger" type="submit">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
            @else
            <li class="nav-item" >
                <a class="nav-link text-decoration-none" href="{{ route('login') }}" >
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="{{ route('register') }}" >
                    <i class="fas fa-user-plus"></i> Register
                </a>
            </li>
            @endauth
        </ul>
    </div>

    <div class="py-5 col-12" >
        <p class="p-0 m-0 text-center" >
            <strong>{{ config('app.name') }}</strong> &copy; {{ date('Y') }}
            <em class="ms-4" ><i class="fas fa-code"></i> Free & Open Source</em>
            <a class="text-decoration-none text-secondary ms-4" href="{{ route('rss') }}" >
                <i class="fas fa-rss"></i> Follow-us
            </a>
        </p>
    </div>

</div>

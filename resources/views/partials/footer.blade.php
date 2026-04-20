<div class="row justify-content-center h5" >
    <div class="p-0 pt-3 m-0 me-3 col-6 border-end border-secondary" >
        <div class="row" >
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('home') }}" ><i class="fas fa-home"></i> Home</a>
            </div>
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('about') }}" ><i class="fas fa-info-circle"></i> About</a>
            </div>
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('contact') }}" ><i class="fas fa-envelope"></i> Contact</a>
            </div>
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('rss') }}" ><i class="fas fa-rss"></i> Follow-us</a>
            </div>
        </div>

        <div class="row" >
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('search') }}" ><i class="fas fa-search"></i> Search</a>
            </div>
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('categories') }}" ><i class="fas fa-sitemap"></i> Categories</a>
            </div>
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('tags') }}" ><i class="fas fa-tag"></i> Tags</a>
            </div>
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('archive') }}" ><i class="fas fa-archive"></i> Archive</a>
            </div>
        </div>

        <div class="row" >
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('chat') }}" ><i class="fas fa-comments"></i> Chat</a>
            </div>
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('authors') }}" ><i class="fas fa-users"></i> Authors</a>
            </div>
        </div>

    </div>

    <div class="p-0 col-2 align-self-center" >
        <ul class="p-0 w-100 list-group list-group-horizontal" >
            @auth
            <li class="list-item p-0 border-0 w-100" >
                <a class="list-link text-primary text-decoration-none" href="{{ route('profile') }}" >
                    <i class="fas fa-user-circle"></i> Profile
                </a>
            </li>
            <li class="list-item p-0 border-0 w-100" >
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-danger text-decoration-none" type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </li>
            @else
            <li class="p-0 border-0 list-group-item w-100" >
                <a class="text-primary text-decoration-none" href="{{ route('login') }}" >
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </li>
            <li class="p-0 border-0 list-group-item w-100" >
                <a class="text-success text-decoration-none" href="{{ route('register') }}" >
                    <i class="fas fa-user-plus"></i> Register
                </a>
            </li>
            @endauth
        </ul>
    </div>

    <div class="py-5 col-12" >
        <p class="p-0 m-0 text-center" ><strong>Laravel Blog</strong> {{ date('Y') }} - <em>Free & Open Source.</em></p>
    </div>
</div>

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
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('categories') }}" ><i class="fas fa-sitemap"></i> Categories</a>
            </div>
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('tags') }}" ><i class="fas fa-tag"></i> Tags</a>
            </div>
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('archive') }}" ><i class="fas fa-archive"></i> Archive</a>
            </div>
            <div class="mb-3 col-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('authors') }}" ><i class="fas fa-users"></i> Authors</a>
            </div>
        </div>
    </div>
    <div class="pt-4 col-2" >
        <div class="pt-1 row" >
            @auth
            <div class="pt-2 col-6" >
                <a class="text-primary text-decoration-none" href="{{ route('profile') }}" ><i class="fas fa-user-circle"></i> Profile</a>
            </div>
            <div class="p-0 col-6" >
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-danger text-decoration-none" type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
            @else
            <div class="pt-2 col-6" >
                <a class="text-primary text-decoration-none" href="{{ route('login') }}" ><i class="fas fa-sign-in-alt"></i> Login</a>
            </div>
            <div class="p-0 pt-2 col-6" >
                <a class="text-success text-decoration-none" href="{{ route('register') }}" ><i class="fas fa-user-plus"></i> Register</a>
            </div>
            @endauth
        </div>
    </div>

    <div class="py-5 col-12" >
        <p class="p-0 m-0 text-center" ><strong>Laravel Blog</strong> {{ date('Y') }} - <em>Free & Open Source.</em></p>
    </div>
</div>

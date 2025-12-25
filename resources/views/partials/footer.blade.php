<div class="row justify-content-center h5" >
    <div class="col-6 border-end border-secondary m-0 p-0 pt-3" >
        <div class="row" >
            <div class="col-3 mb-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('home') }}" ><i class="fas fa-home"></i> Home</a>
            </div>
            <div class="col-3 mb-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('about') }}" ><i class="fas fa-info-circle"></i> About</a>
            </div>
            <div class="col-3 mb-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('contact') }}" ><i class="fas fa-envelope"></i> Contact</a>
            </div>
            <div class="col-3 mb-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('rss') }}" ><i class="fas fa-rss"></i> Follow-us</a>
            </div>
            <div class="col-3 mb-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('categories') }}" ><i class="fas fa-sitemap"></i> Categories</a>
            </div>
            <div class="col-3 mb-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('tags') }}" ><i class="fas fa-tag"></i> Tags</a>
            </div>
            <div class="col-3 mb-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('archive') }}" ><i class="fas fa-archive"></i> Archive</a>
            </div>
            <div class="col-3 mb-3" >
                <a class="text-decoration-none text-secondary" href="{{ route('authors') }}" ><i class="fas fa-users"></i> Authors</a>
            </div>
        </div>
    </div>
    <div class="col-2 pt-4" >
        <div class="row pt-1" >
            @auth
            <div class="col-6 pt-2" >
                <a class="text-primary text-decoration-none" href="{{ route('profile') }}" ><i class="fas fa-user-circle"></i> Profile</a>
            </div>
            <div class="col-6 p-0" >
                <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-danger text-decoration-none" type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
            @else
            <div class="col-6 pt-2" >
                <a class="text-primary text-decoration-none" href="{{ route('auth.login') }}" ><i class="fas fa-sign-in-alt"></i> Login</a>
            </div>
            <div class="col-6 p-0 pt-2" >
                <a class="text-success text-decoration-none" href="{{ route('auth.register') }}" ><i class="fas fa-user-plus"></i> Register</a>
            </div>
            @endauth
        </div>
    </div>

    <div class="col-12 py-5" >
        <p class="text-center p-0 m-0" ><strong>Laravel Blog</strong> {{ date('Y') }} - <em>Free & Open Source.</em></p>
    </div>
</div>

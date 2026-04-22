<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light" >
    <div class="container" >
        <div class="collapse navbar-collapse" id="navbarNav" >
            <ul class="navbar-nav ms-auto h6" >
                <li class="nav-item" >
                    <a class="mt-1 nav-link text-decoration-none text-secondary me-3" href="{{ route('profile') }}" >
                        <i class="fas fa-user-circle"></i> Profile
                    </a>
                </li>
                <li class="nav-item" >
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button class="text-white btn btn-danger btn-sm mt-2" type="submit">
                           <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

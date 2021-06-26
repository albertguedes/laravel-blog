<div class="container-fluid py-0">
    <div class="d-flex pt-3">
        {{ Breadcrumbs::render() }}
    </div>
    <div class="d-flex pt-0">
        <ul class="navbar-nav">
            <li class="nav-item pt-2 pe-4">
                <a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i> {{ auth()->user()->name }}</a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-primary"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>
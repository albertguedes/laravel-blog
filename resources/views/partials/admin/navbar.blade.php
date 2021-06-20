<div class="container px-0">
    <div class="d-flex pt-3">
        {{ Breadcrumbs::render() }}
    </div>
    <div class="d-flex pt-3">
        <ul class="navbar-nav">
            <li class="nav-item pt-2 pe-4">
                Welcome <a href="{{ route('profile') }}">{{ auth()->user()->name }}</a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-primary">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>
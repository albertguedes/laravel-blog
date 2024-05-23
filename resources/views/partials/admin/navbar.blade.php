<div class="container-fluid">

    <div class="d-flex pt-3">
        {{ Breadcrumbs::render() }}
    </div>

    <div class="d-flex">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link text-secondary" href="{{ route('profile') }}"><i class="fas fa-user-circle"></i> {{ auth()->user()->name }}</a>
            </li>
            <li class="nav-item ps-5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-dark"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>

</div>

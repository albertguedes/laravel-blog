<header class="p-0 pt-4 pb-5 text-center" >
    <strong>Admin {{ env('APP_NAME') }}</strong>
</header>

<ul class="nav flex-column px-4">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">Users</a>
    </li>
</ul>
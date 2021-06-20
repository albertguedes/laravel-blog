<header class="py-5 ms-4" >
    <strong>Admin {{ env('APP_NAME') }}</strong>
</header>

<ul class="nav flex-column">
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
<header class="p-0 mx-2 mb-3 text-center border-bottom border-secondary" >
    <div class="fw-bolder text-uppercase" style="padding: 18px 0;" >Admin {{ env('APP_NAME') }}</div>
</header>

<ul class="nav flex-column px-4">
    <li class="nav-item">
        <a class="nav-link text-light" href="{{ route('dashboard') }}">
            <i class="fas fa-border-all"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-light" href="{{ route('categories.index') }}">
            <i class="fas fa-sitemap"></i> Categories
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-light" href="{{ route('tags.index') }}">
            <i class="fas fa-tag"></i> Tags
        </a>
    </li>    
    <li class="nav-item">
        <a class="nav-link text-light" href="{{ route('posts.index') }}">
            <i class="fas fa-newspaper"></i> Posts
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-light" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i> Users
        </a>
    </li>
</ul>
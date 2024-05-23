<header class="p-0 mx-2 mb-3 text-center border-bottom border-secondary py-3" >
    <div class="fw-bolder text-uppercase" >
        Admin {{ env('APP_NAME') }}
    </div>
</header>

<ul id="sidebar-nav" class="nav flex-column px-4">
    <li class="nav-item">
        <a class="nav-link @if(Request::routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
            <i class="fas fa-border-all sidebar-icon"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::routeIs('categories.index')) active @endif" href="{{ route('categories.index') }}">
            <i class="fas fa-sitemap sidebar-icon"></i> Categories
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::routeIs('tags.index')) active @endif" href="{{ route('tags.index') }}">
            <i class="fas fa-tag sidebar-icon"></i> Tags
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::routeIs('posts.index')) active @endif" href="{{ route('posts.index') }}">
            <i class="fas fa-newspaper sidebar-icon"></i> Posts
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::routeIs('users.index')) active @endif" href="{{ route('users.index') }}">
            <i class="fas fa-users sidebar-icon"></i> Users
        </a>
    </li>
</ul>

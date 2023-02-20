<div class="container-fluid p-0 m-0">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavAltMarkup" class="collapse navbar-collapse" >
        <div class="navbar-nav nav-fill w-100" >
            <a class="nav-link" href="{{ route('home') }}" ><i class="fas fa-home"></i> Home</a>
            <a class="nav-link" href="{{ route('about') }}" ><i class="fas fa-info-circle"></i> About</a>
            <a class="nav-link" href="{{ route('categories') }}" ><i class="fas fa-sitemap"></i> Categories</a>
            <a class="nav-link" href="{{ route('tags') }}" ><i class="fas fa-tag"></i> Tags</a>            
            <a class="nav-link" href="{{ route('archive') }}" ><i class="fas fa-archive"></i> Archive</a>
            <a class="nav-link" href="{{ route('contact') }}" ><i class="fas fa-envelope"></i> Contact</a>
            <a class="nav-link" href="{{ route('rss') }}" ><i class="fas fa-rss"></i> Follow-us</a>
        </div>
    </div>
</div>
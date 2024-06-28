<div class="row" >
    <div class="col-12" >
        <ul class="nav justify-content-center" >
            <li class="nav-item" >
                <a class="nav-link" href="{{ route('home') }}" ><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="{{ route('about') }}" ><i class="fas fa-info-circle"></i> About</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="{{ route('categories') }}" ><i class="fas fa-sitemap"></i> Categories</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="{{ route('tags') }}" ><i class="fas fa-tag"></i> Tags</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="{{ route('archive') }}" ><i class="fas fa-archive"></i> Archive</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="{{ route('contact') }}" ><i class="fas fa-envelope"></i> Contact</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="{{ route('rss') }}" ><i class="fas fa-rss"></i> Follow-us</a>
            </li>
        </ul>
    </div>
    <div class="col-12 py-5" >
        <p class="text-center p-0 m-0" ><strong>Laravel Blog</strong> {{ date('Y') }} - <em>Free & Open Source.</em></p>
    </div>
</div>

<div class="w-100 pb-5" >

    <h2 class="text-capitalize" property="headline name">
        <a href="{{ route('post', compact('post')) }}" >
            {{ $post->title }}
        </a>
    </h2>

    <h6 property="datePublished" class="text-black-50" >
        <i class="fas fa-calendar-alt" aria-hidden="true"></i> {{ $post->created_at->format("Y M d") }}
        <span property="author" typeof="Person" >
            <x-authors.link :author-id="$post->author->id" />
        </span>
    </h6>

    <div class="py-3" property="articleBody" >
        {{ $post->description }} <a class="text-danger text-decoration-underline" href="{{ route('post', compact('post')) }}" property="url" >Read Here</a>
    </div>

</div>

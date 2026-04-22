<x-layouts.profile title="Posts" description="List of your posts" >

    <p class="text-start " >
        <a href="{{ route('profile.post.create') }}" class="btn btn-danger">
            <i class="fas fa-plus"></i> Create Post
        </a>
    </p>

    <x-profile.posts.posts-list :posts="$posts" />
</x-layouts.profile>

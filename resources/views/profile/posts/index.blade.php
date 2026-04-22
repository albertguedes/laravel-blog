<x-layouts.profile title="Posts" description="List of your posts" >

    <p class="text-end" >
        <a href="{{ route('profile.post.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Post
        </a>
    </p>

    <x-profile.posts.posts-list :posts="$posts" />
</x-layouts.profile>

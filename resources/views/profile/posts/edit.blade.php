<x-layouts.profile title="Edit Post '{{ $post->title }}'" description="Form to edit a post" >
    <x-profile.posts.post-tabs :post="$post" />
    <x-profile.posts.post-form action="{{ route('profile.post.update', compact('post')) }}" method="PUT" :post="$post" />
</x-layouts.profile>

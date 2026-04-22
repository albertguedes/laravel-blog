<x-layouts.profile title="Post '{{ $post->title }}'" description="Post details" >
    <x-profile.posts.post-tabs :post="$post" />
    <x-common.show-post :post="$post" />
</x-layouts.profile>

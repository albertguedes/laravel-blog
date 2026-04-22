<x-layouts.profile title="Create Post" description="Form to create a post" >
    <x-profile.posts.post-form action="{{ route('profile.post.store') }}" method="POST" :post=null />
</x-layouts.profile>

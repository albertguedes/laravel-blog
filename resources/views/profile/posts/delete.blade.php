<x-layouts.profile title="Delete Post '{{ $post->title }}'" description="Delete a post" >
    <x-profile.posts.post-tabs :post="$post" />

    <div class="row" >

        <div class="pb-3 col-12" >
            <div class="text-center alert alert-warning" role="alert">
                <h2><i class="fas fa-exclamation-triangle"></i> Once you delete this post, there is no going back.</h2>
                <p class="alert-heading">Are you sure?</p>
            </div>
        </div>

        <div class="col-6 text-end">
            <a href="{{ route('profile.post', compact('post')) }}" class="btn btn-lg btn-primary">
                <i class="fas fa-arrow-left"></i> No, i want to back
            </a>
        </div>

        <div class="col-6 text-start">
            <form class="p-0 m-0" action="{{ route('profile.post.destroy', compact('post')) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-lg btn-danger">
                    <i class="fas fa-trash"></i> Yes, delete this post
                </button>
            </form>
        </div>

    </div>
</x-layouts.profile>

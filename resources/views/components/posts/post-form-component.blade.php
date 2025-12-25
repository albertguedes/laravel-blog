<form action="{{ $action }}" method="POST" >

    @csrf

    @if (isset($method))
    <input type="hidden" name="_method" value="{{ $method }}">
    @endif

    @if (isset($post))
    <input type="hidden" name="id" value="{{ $post->id }}" >
    <input type="hidden" name="author_id" value="{{ $post->author->id }}" >
    @else
    <input type="hidden" name="author_id" value="{{ auth()->user()->id }}" >
    @endif

    <div class="input-group mb-3">
        <label for="title" class="input-group-text"><i class="fa fa-edit"></i></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Type a title" value="@if(isset($post)){{ $post->title }}@endif" />
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <label for="slug" class="input-group-text"><i class="fa fa-link"></i></label>
        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Type a slug" value="@if(isset($post)){{ $post->slug }}@endif" />
        @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <label for="description" class="input-group-text"><i class="fa fa-align-left"></i></label>
        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Type a description" >@if(isset($post)){{ $post->description }}@endif</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <label for="content" class="input-group-text"><i class="fa fa-file-alt"></i></label>
        <textarea name="content" rows=25 class="form-control @error('content') is-invalid @enderror" placeholder="Type a content" >@if(isset($post)){{ $post->content }}@endif</textarea>
        @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <label for="post-category" class="input-group-text"><i class="fa fa-sitemap"></i></label>
        @php $current = ($post) ? $post->category : null @endphp
        <x-categories.menu-component name="category_id" :current="$current" />
    </div>

    <div class="input-group mb-3">
        <label for="post-tags" class="input-group-text">
            <i class="fa fa-tags me-3"></i> Check some tags
        </label>
        <x-tags.tags-form-component :post="$post" />
    </div>

    <div class="form-check form-switch mb-3">
        <input
            class="form-check-input"
            type="checkbox"
            id="published"
            name="published"
            value="1"
            {{ old('published', $post->published ?? false) ? 'checked' : '' }}
        >
        <label class="form-check-label" for="published" >Published</label>
    </div>

    <x-send-button-component />

</form>

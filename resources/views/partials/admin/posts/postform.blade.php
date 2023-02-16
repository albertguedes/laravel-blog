@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ $route }}" >

    @csrf

    @if( isset($method) )
    <input type="hidden" name="_method" value="{{ $method }}">
    @endif

    @if( isset($post) )
    <input type="hidden" name="post[id]" value="{{ $post->id }}" >
    <input type="hidden" name="post[author_id]" value="{{ $post->author->id }}" >
    @else
    <input type="hidden" name="post[author_id]" value="{{ auth()->user()->id }}" >
    @endif

    <div class="row pt-4" >

    <div class="col-3" >
            <div class="form-check form-switch">
                <input type="hidden" name="post[published]" value=0 >
                <input class="form-check-input" type="checkbox" name="post[published]" id="check_is_active" @if( isset($post) && $post->published ) checked="checked" @endif value=1 >
                <label class="form-check-label" for="check_is_active">Is Active</label>
            </div>
        </div>
    </div>

    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Title</label>
            <input type="text" name="post[title]" class="form-control @error('post.title') is-invalid @enderror" value="@if(isset($post)){{ $post->title }}@endif" />
            @error('post.title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Slug</label>
            <input type="text" name="post[slug]" class="form-control @error('post.slug') is-invalid @enderror" value="@if(isset($post)){{ $post->slug }}@endif" />
            @error('post.slug')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" for="post-category" >Category</label>
            @if(isset($post))
            {!! category_select($post) !!}
            @else
            {!! category_select() !!}
            @endif
        </div>
    </div>

    <div class="row pt-4" >
        <div class="col-12" >
            <p><label class="form-label" for="post-tags" >Tags</label></p>
            @if(isset($post))
            {!! tags_checkbox($post) !!}
            @else
            {!! tags_checkbox() !!}
            @endif
        </div>
    </div>

    <div class="row pt-4" >
        <div class="col-6" >
            <label class="form-label" >Description</label>
            <textarea name="post[description]" rows=4 class="form-control @error('post.description') is-invalid @enderror" >@if(isset($post)){{ $post->description }}@endif</textarea>
            @error('post.description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row pt-4" >
        <div class="col-6" >
            <label class="form-label" >Content</label>
            <textarea name="post[content]" rows=50 class="form-control @error('post.content') is-invalid @enderror" >@if(isset($post)){{ $post->content }}@endif</textarea>
            @error('post.content')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row pt-4" >
        <div class="col-3" >
            <input type="submit" class="btn btn-primary" value="Submit" />
        </div>
    </div>

</form>

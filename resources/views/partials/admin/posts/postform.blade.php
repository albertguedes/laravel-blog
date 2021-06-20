<form method="POST" action="{{ $route }}" >
    @csrf
    @if(isset($method))
    <input type="hidden" name="_method" value="{{ $method }}">
    @endif
    @if(isset($post))
    <input type="hidden" name="post[id]" value="{{ $post->id }}" >
    @endif
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Title</label>
            <input type="text" name="post[tile]" class="form-control" value="@if(isset($post)){{ $post->title }}@endif" />
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-6" >
            <label class="form-label" >Content</label>
            <textarea name="post[content]" class="form-control" >@if(isset($post)){{ $post->content }}@endif</textarea>
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <input type="submit" class="btn btn-primary" value="Submit" />
        </div>
    </div>
</form>
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
    @if( isset($tag) && !is_null($tag) )
    <input type="hidden" name="tag[id]" value="{{ $tag->id }}" >
    @endif
    <div class="row pt-4" >
        <div class="col-3" >
            <div class="form-check form-switch" >
                <input type="hidden" name="tag[is_active]" value=0 >
                <input class="form-check-input bg-danger border-danger" type="checkbox" name="tag[is_active]" id="check_is_active" @if( isset($tag) && $tag->is_active ) checked="checked" @endif value=1 >
                <label class="form-check-label" for="check_is_active" >Is Active</label>
            </div>
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Title</label>
            <input type="text" name="tag[title]" class="form-control @error('tag.title') is-invalid @enderror" value="@if(isset($tag)){{ $tag->title }}@endif" />
            @error('tag.title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Slug</label>
            <input type="text" name="tag[slug]" class="form-control @error('tag.slug') is-invalid @enderror" value="@if(isset($tag)){{ $tag->slug }}@endif" />
            @error('tag.slug')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-6" >
            <label class="form-label" >Description</label>
            <textarea name="tag[description]" rows=4 class="form-control @error('tag.description') is-invalid @enderror" >@if(isset($tag)){{ $tag->description }}@endif</textarea>
            @error('tag.description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <input type="submit" class="btn btn-dark" value="Submit" />
        </div>
    </div>
</form>

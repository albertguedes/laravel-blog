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
    @if( isset($category) && !is_null($category) )
    <input type="hidden" name="category[id]" value="{{ $category->id }}" >
    @endif
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" for="parent_id" >Parent Category</label>
            {!! category_select( 'category[parent_id]',$category->parent) !!}
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <div class="form-check form-switch" >
                <input type="hidden" name="category[is_active]" value=0 >
                <input class="form-check-input" type="checkbox" name="category[is_active]" id="check_is_active" @if( isset($category) && $category->is_active ) checked="checked" @endif value=1 >
                <label class="form-check-label" for="check_is_active" >Is Active</label>
            </div>
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Title</label>
            <input type="text" name="category[title]" class="form-control @error('category.title') is-invalid @enderror" value="@if(isset($category)){{ $category->title }}@endif" />
            @error('category.title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Slug</label>
            <input type="text" name="category[slug]" class="form-control @error('category.slug') is-invalid @enderror" value="@if(isset($category)){{ $category->slug }}@endif" />
            @error('category.slug')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-6" >
            <label class="form-label" >Description</label>
            <textarea name="category[description]" rows=4 class="form-control @error('category.description') is-invalid @enderror" >@if(isset($category)){{ $category->description }}@endif</textarea>
            @error('category.description')
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
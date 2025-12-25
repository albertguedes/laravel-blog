@if(!empty($tags))
<ul class="list-unstyled d-flex flex-wrap align-items-center h6">
    @foreach ($tags as $tag)
    <li class="list-item align-middle pe-3" >
        <div class="form-check">
            <input id="tag-{{ $tag['id'] }}"
                class="form-check-input"
                type="checkbox"
                name="tags[]"
                value="{{ $tag['id'] }}"
                @if($tag['checked']) checked @endif
            >
            <label class="form-check-label mt-1" for="tag-{{ $tag['id'] }}" >
                {{ ucwords($tag['title']) }}
            </label>
        </div>
    </li>
    @endforeach
</ul>
@else
<p>No Tags Registred.</p>
@endif

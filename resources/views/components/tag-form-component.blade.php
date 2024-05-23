<div>
    @if(!empty($tags))
    <ul class="list-unstyled d-flex flex-wrap align-items-center">
    @foreach ($tags as $tag)
    <li class="list-item me-4">
        <input id="tag-{{ $tag['id'] }}"
            class="form-check-input"
            type="checkbox"
            name="post[tags][]"
            value="{{ $tag['id'] }}"
            @if($tag['checked']) checked @endif
        >
        <label class="form-check-label" for="tag-{{ $tag['id'] }}">
            {{ ucwords($tag['title']) }}
        </label>
    </li>
    @endforeach
</ul>

    @else
        <p>No Tags Registred.</p>
    @endif
</div>

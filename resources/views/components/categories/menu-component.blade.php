<select class='form-select' aria-label='Category Selector' name='{{ $name }}' >";
    <option value='' {{ ( $current == null ) ? 'selected="selected"' : '' }} >Select an category</option>
    @foreach($categories as $category)
    <option  value='{{ $category['id'] }}' @if($category['selected']) selected @endif  >
        {{ strtoupper($category['path'] . $category['title']) }}</span>
    </option>
    @endforeach
</select>

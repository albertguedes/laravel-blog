<div>
    <select class='form-select' aria-label='Category Selector' name='{{ $name }}' >";
        <option value='' {{ ( $current == null ) ? 'selected="selected"' : '' }} >None</option>
        {!! $category_select_option($roots,0,$current) !!}
    </select>
</div>

@php $random = mt_rand(100000, 999999); @endphp
<li data-name="{{ $name }}" data-index="{{ $index ?? $random }}" class="ui-sortable-handle sortable-menu-list-li" style="{{ $style ?? '' }}">
    <span>
        @isset($default)
        <input type="hidden" name="menu[{{ $index ?? $random }}][default]" readonly value="{{ $default ?? 1 }}">
        @endisset
        <input type="hidden" name="menu[{{ $index ?? $random }}][id]" readonly value="{{ $id ?? null }}">
        <input type="hidden" name="menu[{{ $index ?? $random }}][parent_id]" readonly value="{{ $parent_id ?? null }}">
        <input type="hidden" name="menu[{{ $index ?? $random }}][label]" readonly value="{{ $label ?? 1 }}">
        <input type="hidden" name="menu[{{ $index ?? $random }}][value]" readonly value="{{ $value ?? 1 }}">
        <input type="hidden"  class="sortable-depth" name="menu[{{ $index ?? $random }}][sort]" readonly value="{{ $sort ?? 1 }}">
        <input type="hidden" name="menu[{{ $index ?? $random }}][class]" readonly value="{{ $class ?? 1 }}">
        <input type="hidden" name="menu[{{ $index ?? $random }}][icon]" readonly value="{{ $icon ?? 1 }}">
        <input type="hidden" name="menu[{{ $index ?? $random }}][target]" readonly value="{{ $target ?? 1 }}">
        <input type="hidden" name="menu[{{ $index ?? $random }}][menu-type]" readonly value="{{ $menuType ?? \Foundation\Lib\Nav::only($type, false, 'types') }}">
        <i class="fa fa-sort" aria-hidden="true"></i>&nbsp;<i class="icon-home"></i> <span class="menu-title">{{ $name }}</span>
        <small class="pull-right" style="margin-right: 15px;font-weight: bold;margin-top: 4px;">
            <a class="edit-menu-li" href="#" data-menu-type="{{ $type }}">
                <i class="fa fa-cog"></i> Setting
            </a>
            <code class="menu-type">[{{ \Foundation\Lib\Nav::only($type, false, 'types') }}]</code>
            <a class="text-danger remove-menu-li" href="#">
                <i class="fa fa-trash-o"></i> Delete
            </a>
        </small>
    </span>

        <ul class="sorter ui-sortable">
            @isset($children)
                @foreach($children as $child)
                    @php $type = $child->nav_li_type; @endphp
                    <li data-name="Category" class="ui-sortable-handle">
                        <span>
                            <input type="hidden" name="menu[][id]" readonly value="{{ $child->id }}">
                            <input type="hidden" name="menu[][parent_id]" readonly value="{{ $child->parent_id }}">
                            <input type="hidden" name="menu[][label]" readonly value="{{ $child->label ?? 1 }}">
                            <input type="hidden" name="menu[][value]" readonly value="{{ $child->value ?? 1 }}">
                            <input type="hidden" name="menu[][sort]" readonly value="{{ $child->sort ?? 1 }}">
                            <input type="hidden" name="menu[][class]" readonly value="{{ $child->class ?? 1 }}">
                            <input type="hidden" name="menu[][icon]" readonly value="{{ $child->icon ?? 1 }}">
                            <input type="hidden" name="menu[][target]" readonly value="{{ $child->target ?? 1 }}">
                            <input type="hidden" name="menu[][menu-type]" readonly value="{{ \Foundation\Lib\Nav::only($type, false, 'types') }}">
                            <i class="fa fa-sort" aria-hidden="true"></i>&nbsp;<i class="icon-home"></i> <span class="menu-title">{{ $child->label  }}</span>
                            <small class="pull-right" style="margin-right: 15px;font-weight: bold;margin-top: 4px;">
                                <a class="edit-menu-li" href="#">
                                    <i class="fa fa-cog"></i> Setting
                                </a>
                                <code class="menu-type">[{{ \Foundation\Lib\Nav::only($type, false, 'types') }}]</code>
                            </small>
                        </span>
                    </li>
                @endforeach
            @endisset
        </ul>
</li>

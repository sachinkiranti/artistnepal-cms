<ul class="sorter ui-sortable sortable-menu-list">
    @isset($menus)

        @foreach($menus as $menu)

            @include('admin.appearance.menu.partials.sortable-menu-li', [
                'id' => $menu->id,
                'parent_id' => $menu->parent_id,
                'name' => $menu->label,
                'label' => $menu->label,
                'menuType' => $menu->nav_li_type,
                'type' => $menu->nav_li_type,
                'sort' => $menu->sort,
                'value' => $menu->value,
                'class' => $menu->class,
                'icon' => $menu->icon,
                'target' => $menu->target,
                'index' => $loop->index,
                'children' => $menu->children ?? null,
            ])

        @endforeach

        @include('admin.appearance.menu.partials.sortable-menu-li', [
            'name' => 'Home',
            'section' => 'primary-menu',
            'type' => $section,
            'style' =>  'display: none;',
            'children' => $children ?? null,
            'default' => true, // For cloning process only
        ])
    @endisset
</ul>

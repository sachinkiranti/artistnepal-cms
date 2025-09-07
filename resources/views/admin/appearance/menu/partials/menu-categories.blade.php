<div class="card">
    <div class="card-header" id="headingFour">
        <b class="mb-0">
            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour">
                <b>Categories</b>
            </button>
        </b>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
        <div class="card-body">
            <ul class="menu-props list-group list-group-flush" style="height: 200px; overflow: auto">
                @forelse($data as $category)
                    @include('admin.appearance.menu.partials.menu-li', [
                        'title' => $category->category_full_name ?? $category->category_name,
                        'type'  => 'category',
                        'id'    => $category->unique_identifier,
                    ])
                    @empty
                    <p>No Category Added!</p>
                @endforelse
            </ul>
            <button class="btn btn-xs btn-primary add-to-menu" data-menu-type="Category"><i class="fa fa-plus"></i> Add To Menu</button>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header" id="headingTwo">
        <b class="mb-0">
            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo">
                <b>Pages</b>
            </button>
        </b>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
            <ul class="list-group list-group-flush" style="height: 200px; overflow: auto">
                @forelse($data as $page)
                    @include('admin.appearance.menu.partials.menu-li', [
                        'title' => $page->title,
                        'type'  => 'page',
                        'id'    => $page->slug,
                    ])
                @empty
                    <p>{{ __('No pages Found!') }}</p>
                @endforelse
            </ul>
            <button class="btn btn-xs btn-primary add-to-menu" data-menu-type="Page"><i class="fa fa-plus"></i> Add To Menu</button>
        </div>
    </div>
</div>

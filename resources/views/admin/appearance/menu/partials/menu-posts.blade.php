<div class="card">
    <div class="card-header" id="headingOne">
        <b class="mb-0">
            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne">
                <b>Posts</b>
            </button>
        </b>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <ul class="menu-props list-group list-group-flush" style="height: 200px; overflow: auto">
                @forelse($data as $post)
                    @include('admin.appearance.menu.partials.menu-li', [
                        'title' => $post->title,
                        'type'  => 'post',
                        'id'    => $post->unique_identifier,
                    ])
                    @empty
                    <p>{{ __('No posts Found!') }}</p>
                @endforelse
            </ul>
            <button class="btn btn-xs btn-primary add-to-menu" data-menu-type="Post"><i class="fa fa-plus"></i> Add To Menu</button>
        </div>
    </div>
</div>

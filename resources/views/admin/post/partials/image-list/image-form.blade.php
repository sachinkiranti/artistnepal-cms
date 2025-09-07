<div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Image List</h5>
        </div>
        <div class="ibox-content gallery-manager">
            <div class="hr-line-dashed"></div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>
                            <a href="#" class="btn btn-primary pull-right btn-xs add-gallery" title="Add new image"><i class="fa fa-plus"></i></a>
                        </th>
                    </tr>
                </thead>

                <tbody>


                @isset($data['post-images'])
                    @forelse($data['post-images'] as $picture)
                        @include('admin.post.partials.image-list.gallery-tr', [ 'image' => $picture->image, ])
                        @empty
                        @include('admin.post.partials.image-list.gallery-tr')
                    @endforelse
                    @else
                    @include('admin.post.partials.image-list.gallery-tr')
                @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

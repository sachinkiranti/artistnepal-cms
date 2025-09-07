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
                        <th>Summary</th>
                        <th></th>
                        <th>
                            <a href="#" class="btn btn-primary btn-xs add-gallery" title="Add new image"><i class="fa fa-plus"></i></a>
                        </th>
                    </tr>
                </thead>

                <tbody>


                @isset($data['gallery-images'])
                    @forelse($data['gallery-images'] as $picture)
                        @include('admin.gallery.partials.gallery-tr', [ 'image' => $picture->image, ])
                        @empty
                        @include('admin.gallery.partials.gallery-tr')
                    @endforelse
                    @else
                    @include('admin.gallery.partials.gallery-tr')
                @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

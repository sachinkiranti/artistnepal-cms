<div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            Post List
        </div>
        <div class="ibox-content ibox-content-custom">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th width="150px">Title</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['user']->posts as $post)
                    <tr>
                        <td style="width:65%;">
                            <a href="{{ route('admin.post.show', $post->id) }}" style="color: #0a0302">{{ $post->title }}</a>
                        </td>
                        <td style="width:35%">
                                <span class="label label-{{ $post->status ? 'success' : 'danger' }}">
                                    {{ \Kiranti\Config\Status::$current[$post->status] }}
                                </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            <p class="text-center">No Posts !</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="hr-line-dashed"></div>

            {{ $data['user']->posts->links() }}
        </div>
    </div>
</div>

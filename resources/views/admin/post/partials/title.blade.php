{{ $data->title }}  <br>
@if ($data->post_type)
<span class="badge badge-primary" title="Page">Page</span>
@endif

@if ($data->is_flash_news)
<span class="fa fa-flash" title="Flash News"></span>
@endif
@if (!$data->is_author_visible)
<span class="fa fa-user-secret" title="Author is hidden"></span>
@endif

@if(!$data->is_thumbnail_visible)
<span class="fa fa-file" title="Thumbnail is hidden"></span>
@endif

@if($data->is_bises_news)
    <span class="fa fa-linode" title="Bises News"></span>
@endif

@if($data->is_pramukh_news)
    <span class="fa fa-star" title="Pramukh News"></span>
@endif

@include('admin.common.language-input', [ 'language' => $data['post']->lang ?? null ])

<div class="col-lg-8">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>General Info</h5>
            @isset($data['post'])
            <p class="pull-right">
                <b style="text-decoration: underline;">Views : {{ $data['post']->views }}</b>
                <a href="{{ route('post.single', $data['post']->unique_identifier) }}" target="_blank" title="Show to Frontend"><i class="fa fa-eye btn btn-primary btn-xs"></i> </a>
            </p>
            @endisset
        </div>
        <div class="ibox-content">
            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Title <span class="required">*</span></label>
                <div class="col-sm-12 {{ $errors->has('title') ? 'has-error' : '' }}">
                    {!! Form::text('title', null, [ 'class' => 'form-control post-title' ]) !!}
                    @if($errors->has('title'))
                        <label class="has-error" for="title">{{ $errors->first('title') }}</label>
                    @endif
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Secondary Title</label>
                <div class="col-sm-12 {{ $errors->has('secondary_title') ? 'has-error' : '' }}">
                    {!! Form::text('secondary_title', null, [ 'class' => 'form-control post-secondary_title' ]) !!}
                    @if($errors->has('secondary_title'))
                        <label class="has-error" for="secondary_title">{{ $errors->first('secondary_title') }}</label>
                    @endif
                </div>
            </div>

            <div class="hr-line-dashed"></div>

{{--            <div class="form-group row">--}}
{{--                <label class="col-sm-12 col-form-label is_required">Slug <span class="required">*</span></label>--}}
{{--                <div class="col-sm-12 {{ $errors->has('slug') ? 'has-error' : '' }}">--}}
{{--                    {!! Form::text('slug', null, [ 'class' => 'form-control post-slug' ]) !!}--}}
{{--                    @if($errors->has('slug'))--}}
{{--                        <label class="has-error" for="slug">{{ $errors->first('slug') }}</label>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="hr-line-dashed"></div>--}}
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Content</label>
                <div class="col-sm-12 {{ $errors->has('content') ? 'has-error' : '' }}">
                    {!! Form::textarea('content', null, [ 'class' => 'form-control', 'id' => 'content', ]) !!}
                    @if($errors->has('content'))
                        <label class="has-error" for="content">{{ $errors->first('content') }}</label>
                    @endif
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            @include('admin.common.seo', [
                'seo' => $data['post'] ?? [],
            ])
            <div class="pb-3"></div>
            <div class="hr-line-dashed"></div>

        </div>
    </div>

    <div class="ibox">
        @include('admin.post.partials.image-list.image-form')
    </div>
</div>
<div class="col-lg-4">

    <div class="ibox ">
        <div class="ibox-title">
            <h5>Status</h5>
        </div>
        <div class="ibox-content pb-1">

            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="i-checks i-checks-checkbox mt-2">
                        <label for="active"> {!! Form::radio('status', 1, true, ['id' => 'active']) !!} <i></i> Publish </label>  &nbsp;&nbsp;
                        <label for="inactive"> {!! Form::radio('status', 0, false, ['id' => 'inactive']) !!} <i></i> Save as Draft </label>
                        <div>
                            @if($errors->has('status'))
                                <label class="has-error" for="status">{{ $errors->first('status') }}</label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label">Publish Date </label>
                <div class="col-sm-12 {{ $errors->has('published_date') ? 'has-error' : '' }}">

                    {!! Form::datetimeLocal('published_date', $data['published_date'] ?? null, [ 'class' => 'form-control', ]) !!}

                @if($errors->has('published_date'))
                        <label class="has-error" for="content">{{ $errors->first('published_date') }}</label>
                    @endif
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Post Type <span class="required">*</span></label>
                <div class="col-sm-12 {{ $errors->has('post_type') ? 'has-error' : '' }}">
                    {!! Form::select('post_type', $data['post-type'], null, [ 'class' => 'form-control text-capitalize', ]) !!}
                    @if($errors->has('post_type'))
                        <label class="has-error" for="content">{{ $errors->first('post_type') }}</label>
                    @endif
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Tag</label>
                <div class="col-sm-12 {{ $errors->has('tag') ? 'has-error' : '' }}">
                    {!! Form::select('tags[]', $data['tag'], null, [ 'class' => 'form-control text-capitalize post-select-multiple', 'multiple' =>'multiple', ]) !!}
                    @if($errors->has('tags'))
                        <label class="has-error" for="tags">{{ $errors->first('tags') }}</label>
                    @endif
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Category <span class="required">*</span></label>
                <div class="col-sm-12 {{ $errors->has('category_id') ? 'has-error' : '' }}">
                    {!! Form::select('category_id', $data['category'], null, [ 'class' => 'form-control category-select', 'id'=>'select-category', 'placeholder' => 'Select Category' ]) !!}
                    @if($errors->has('category_id'))
                        <label class="has-error" for="category_id">{{ $errors->first('category_id') }}</label>
                    @endif
                </div>
            </div>

            <div class="sub-category-wrapper"></div>

            @if (auth()->user()->hasAccess())
                <div class="hr-line-dashed"></div>
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label is_required">Author</label>
                    <div class="col-sm-12 {{ $errors->has('created_by') ? 'has-error' : '' }}">
                        {!! Form::select('created_by', $data['created_by'], null, [ 'class' => 'form-control created_by-select', 'id'=>'select-created_by', 'placeholder' => 'Select Author' ]) !!}
                        <div class="hr-line-dashed"></div>
                        {!! Form::text('author', null, [ 'class' => 'form-control', 'placeholder' => 'Enter the author name' ]) !!}
                        @if($errors->has('created_by'))
                            <label class="has-error" for="created_by">{{ $errors->first('created_by') }}</label>
                        @endif
                    </div>
                </div>
            @endif

            <div class="hr-line-dashed"></div>

            <div class="form-group row">
                <div class="col-sm-12 {{ $errors->has('is_author_visible') ? 'has-error' : '' }}">

                    <div class="i-checks">
                        <label style="cursor: pointer;">{!! Form::checkbox('is_author_visible', null, $data['post']->is_author_visible ?? 'on', [ 'class' => 'i-checks-checkbox', ]) !!} Show Author <i class="fa fa-smile-o"></i> </label>
                    </div>

                    @if($errors->has('is_author_visible'))
                        <label class="has-error" for="is_author_visible">{{ $errors->first('is_author_visible') }}</label>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <div class="ibox">
        <div class="ibox-title">
            <h5>Media</h5>
        </div>

        <div class="ibox-content pb-1">

            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Media Display Type</label>
                <div class="col-sm-12 {{ $errors->has('media_display_type') ? 'has-error' : '' }}">
                    {!! Form::select('media_display_type', $data['media_display_type'], null, [ 'class' => 'form-control media_display_type-select', 'id'=>'select-media_display_type', ]) !!}
                    @if($errors->has('media_display_type'))
                        <label class="has-error" for="media_display_type">{{ $errors->first('media_display_type') }}</label>
                    @endif
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Video Url</label>
                <div class="col-sm-12 {{ $errors->has('video_url') ? 'has-error' : '' }}">
                    {!! Form::textarea('video_url', null, [ 'class' => 'form-control', 'placeholder' => 'Enter the video url or embed iframe', 'rows' => 5, ]) !!}
                    @if($errors->has('video_url'))
                        <label class="has-error" for="video_url">{{ $errors->first('video_url') }}</label>
                    @endif
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Featured Image</label>
                <div class="col-sm-12 {{ $errors->has('image_holder') ? 'has-error' : '' }}">

                    @php
                        $file = [
                            'id' => 'image-path',
                            'class' => 'form-control dropify img-responsive',
                            'data-plugin' => 'dropify',
                            'data-height' => 200,
                            'data-show-remove' => false,
                            'data-allowed-file-extensions' => 'png jpeg jpg gif',
                            'data-disable-remove' => true,
                            'data-max-file-size' => '2M',
                        ];

                        if (isset($data['post']->image) && file_exists(public_path('storage/images/posts/'.$data['post']->image))) {
                            $file['data-default-file'] = asset('storage/images/posts/'.$data['post']->image);
                        }
                    @endphp

                    {!! Form::file('image_holder', $file, [ 'class' => 'form-control', ]) !!}
                    @if($errors->has('image_holder'))
                        <label class="has-error" for="image_holder">{{ $errors->first('image_holder') }}</label>
                    @endif
                </div>

            </div>

            <div class="hr-line-dashed"></div>

            <div class="col-sm-12 {{ $errors->has('featured_news_caption') ? 'has-error' : '' }}">
                {!! Form::textarea('featured_news_caption', null, [ 'class' => 'form-control', 'rows' => 5, 'placeholder' => 'Enter the caption for featured Image', ]) !!}
                @if($errors->has('featured_news_caption'))
                    <label class="has-error" for="featured_news_caption">{{ $errors->first('featured_news_caption') }}</label>
                @endif
            </div>

            @isset($data['post'])

            <div class="hr-line-dashed"></div>

            <div class="form-group row">
                <div class="col-sm-12 {{ $errors->has('remove_thumbnail') ? 'has-error' : '' }}">

                    <div class="i-checks">
                        <label style="cursor: pointer;">{!! Form::checkbox('remove_thumbnail', null, $data['post']->remove_thumbnail ?? null, [ 'class' => 'i-checks-checkbox', ]) !!} Remove Thumbnail </label>
                    </div>

                    @if($errors->has('remove_thumbnail'))
                        <label class="has-error" for="remove_thumbnail">{{ $errors->first('remove_thumbnail') }}</label>
                    @endif
                </div>
            </div>
            @endisset

            <div class="hr-line-dashed"></div>

            <div class="form-group row">
                <div class="col-sm-12 {{ $errors->has('is_thumbnail_visible') ? 'has-error' : '' }}">

                    <div class="i-checks">
                        <label style="cursor: pointer;">{!! Form::checkbox('is_thumbnail_visible', null, $data['post']->is_thumbnail_visible ?? 'on', [ 'class' => 'i-checks-checkbox', ]) !!} Show Thumbnail on Homepage <i class="fa fa-angellist"></i> </label>
                    </div>

                    @if($errors->has('is_thumbnail_visible'))
                        <label class="has-error" for="is_thumbnail_visible">{{ $errors->first('is_thumbnail_visible') }}</label>
                    @endif
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group row">

                <div class="col-sm-12">

                    <div class="i-checks">
                        <label style="cursor: pointer;">
                            {!! Form::checkbox('has_watermark', null, $data['post']->has_watermark ?? null, [ 'class' => 'i-checks-checkbox', ]) !!} Has Watermark
                        </label>
                    </div>

                    @if($errors->has('has_watermark'))
                        <label class="has-error" for="has_watermark">{{ $errors->first('has_watermark') }}</label>
                    @endif

                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Watermark Position</label>
                <div class="col-sm-12 {{ $errors->has('watermark_position') ? 'has-error' : '' }}">
                    {!! Form::select('watermark_position', $data['positions'], null, [ 'class' => 'form-control text-capitalize', ]) !!}
                    @if($errors->has('watermark_position'))
                        <label class="has-error" for="content">{{ $errors->first('watermark_position') }}</label>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-title">
            <h5>Utilities</h5>
        </div>

        <div class="ibox-content pb-1">
            <div class="hr-line-dashed"></div>

            <div class="form-group row">
                <div class="col-sm-12 {{ $errors->has('disable_facebook_comment') ? 'has-error' : '' }}">

                    <div class="i-checks">
                        <label style="cursor: pointer;">{!! Form::checkbox('disable_facebook_comment', null, $data['post']->disable_facebook_comment ?? '', [ 'class' => 'i-checks-checkbox', ]) !!} Disable Facebook Comment <i class="fa fa-facebook"></i> </label>
                    </div>

                    @if($errors->has('disable_facebook_comment'))
                        <label class="has-error" for="disable_facebook_comment">{{ $errors->first('disable_facebook_comment') }}</label>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 {{ $errors->has('disable_disqus_comment') ? 'has-error' : '' }}">

                    <div class="i-checks">
                        <label style="cursor: pointer;">{!! Form::checkbox('disable_disqus_comment', null, $data['post']->disable_disqus_comment ?? 'on', [ 'class' => 'i-checks-checkbox', ]) !!} Disable Disqus Comment <i class="fa fa-disqus"></i> </label>
                    </div>

                    @if($errors->has('disable_disqus_comment'))
                        <label class="has-error" for="disable_disqus_comment">{{ $errors->first('disable_disqus_comment') }}</label>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 {{ $errors->has('disable_site_comment') ? 'has-error' : '' }}">

                    <div class="i-checks">
                        <label style="cursor: pointer;">{!! Form::checkbox('disable_site_comment', null, $data['disable_site_comment'] ?? 'on', [ 'class' => 'i-checks-checkbox', ]) !!} Disable Site Comment <i class="fa fa-commenting-o"></i> </label>
                    </div>

                    @if($errors->has('disable_site_comment'))
                        <label class="has-error" for="disable_site_comment">{{ $errors->first('disable_site_comment') }}</label>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 {{ $errors->has('disable_reaction') ? 'has-error' : '' }}">

                    <div class="i-checks">
                        <label style="cursor: pointer;">{!! Form::checkbox('disable_reaction', null, $data['disable_reaction'] ?? null, [ 'class' => 'i-checks-checkbox', ]) !!} Disable Reaction <i class="fa fa-smile-o"></i> </label>
                    </div>

                    @if($errors->has('disable_reaction'))
                        <label class="has-error" for="disable_reaction">{{ $errors->first('disable_reaction') }}</label>
                    @endif
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Type <br><small>Mark the given post as </small> </label>

                <div class="col-sm-12 {{ $errors->has('type') ? 'has-error' : '' }}">
                    <div class="i-checks">
                        <label style="cursor: pointer;">{!! Form::checkbox('is_default_news', null, $data['post']->is_default_news ?? 'on', [ 'class' => 'i-checks-checkbox', ]) !!} Default News  </label>
                    </div>

                    @if (auth()->user()->hasAccess())
                        <div class="i-checks">
                            <label style="cursor: pointer;">{!! Form::checkbox('is_flash_news', null, $data['post']->is_flash_news ?? false, [ 'class' => 'i-checks-checkbox', ]) !!} Flash News <span class="fa fa-flash" title="Flash News"></span></label>
                        </div>

                        <div class="i-checks">
                            <label style="cursor: pointer;">{!! Form::checkbox('is_bises_news', null, $data['post']->is_bises_news ?? false, [ 'class' => 'i-checks-checkbox', ]) !!} Bises News <span class="fa fa-linode" title="Bises News"></span> </label>
                        </div>

                        <div class="i-checks">
                            <label style="cursor: pointer;">{!! Form::checkbox('is_pramukh_news', null, $data['post']->is_pramukh_news ?? false, [ 'class' => 'i-checks-checkbox', ]) !!} Pramukh News <span class="fa fa-star" title="Pramukh News"></span> </label>
                        </div>
                    @endif
                    @if($errors->has('type'))
                            <label class="has-error" for="content">{{ $errors->first('type') }}</label>
                        @endif
                    </div>

                </div>

            <div class="hr-line-dashed"></div>
        </div>
    </div>

</div>


<div class="seo-manager">
    <div class="seo-manager-head">
        @unless(isset($globalSeo))
            <h1 class=""> <i class="fa fa-eye"></i><span>SEO</span></h1>
        @endunless
        <span class="google-search-pre">Google search Preview</span>
        <div class="seo-title">{{ old('seo_title') ?? $seo->seo_title ?? '' }}</div>
        <div class="seo-url">{{ url('/') }}/<span class="seo-slug">{{ old('seo_slug') ?? $seo->seo_slug ?? '' }}</span></div>
        <div class="seo-desc">{{ old('seo_desc') ?? $seo->seo_desc ?? '' }}</div>
    </div>

    <div class="seo-manager-body" style="@if(!isset($globalSeo)) display: none; @endif">

            <div class="form-group row">
                <label class="col-sm-12 col-form-label">Seo Title</label>
                <div class="col-sm-12 {{ $errors->has('seo_title') ? 'has-error' : '' }}">
                    {!! Form::text('seo_title', null, [ 'class' => 'form-control seo-title-field' ]) !!}
                    @if($errors->has('seo_title'))
                        <label class="has-error" for="seo-desc">{{ $errors->first('seo_title') }}</label>
                    @endif
                </div>
            </div>

            <div class="hr-line-dashed"></div>
        @unless(isset($globalSeo))
            <div class="form-group  row">
                <label class="col-sm-12 col-form-label">Seo Slug</label>
                <div class="col-sm-12 {{ $errors->has('seo_slug') ? 'has-error' : '' }}">
                    {!! Form::text('seo_slug', null, [ 'class' => 'form-control seo-slug-field' ]) !!}
                    @if($errors->has('seo_slug'))
                        <label class="has-error" for="seo-slug">{{ $errors->first('seo_slug') }}</label>
                    @endif
                </div>
            </div>
            <div class="hr-line-dashed"></div>
        @endunless
        <div class="form-group  row">
            <label class="col-sm-12 col-form-label ">Seo meta tag description</label>
            <div class="col-sm-12 {{ $errors->has('seo_desc') ? 'has-error' : '' }}">
                {!! Form::textarea('seo_desc', null, [ 'class' => 'form-control seo-desc-field', 'rows' => 3, ]) !!}
                @if($errors->has('seo_desc'))
                    <label class="has-error" for="seo-desc">{{ $errors->first('seo_desc') }}</label>
                @endif
            </div>
        </div>

        <div class="hr-line-dashed"></div>
        <div class="form-group  row">
            <label class="col-sm-12 col-form-label ">Seo meta tag keywords </label>
            <div class="col-sm-12 {{ $errors->has('seo_keywords') ? 'has-error' : '' }}">
                {!! Form::textarea('seo_keywords', null, [ 'class' => 'form-control seo-keywords', 'rows' => 3, ]) !!}
                @if($errors->has('seo_keywords'))
                    <label class="has-error" for="seo-keywords">{{ $errors->first('seo_keywords') }}</label>
                @endif
            </div>
        </div>
    </div>
</div>

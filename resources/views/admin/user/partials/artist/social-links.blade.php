<div role="tabpanel" id="tab-social_links" class="tab-pane">
    <div class="panel-body">

        @foreach(\Foundation\Enums\SocialLinks::cases() as $socialLink)
        <div class="row">
            <div class="col-sm-12">
                <label class=" col-form-label is_required">
                    <b>{{ ucwords(Str::replace('_', " ", $socialLink->value)) }} <span class="required">*</span></b>
                </label>
                <div class=" {{ $errors->has('social_links.'.$socialLink->value)?'has-error':'' }}">
                    {!! Form::url('social_links['.$socialLink->value.']', null, [ 'class' => 'form-control', ]) !!}
                    @if($errors->has('social_links.'.$socialLink->value))
                        <label class="has-error" for="social_links.{{$socialLink->value}}">
                            {{ $errors->first('social_links.'.$socialLink->value) }}
                        </label>
                    @endif
                </div>
            </div>
        </div>

            @if(!$loop->last)
                <div class="hr-line-dashed"></div>
            @endif

        @endforeach

    </div>
</div>

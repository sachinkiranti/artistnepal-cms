<div class="modal inmodal" id="menu-model" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title"> <i class="fa fa-cogs"></i> Edit Configuration</h4>
                <small class="font-bold modal-description"></small>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row col-sm-12">
                        <label class="col-sm-12 col-form-label is_required"><b>Label</b> <span class="required" style="color: red;">*</span></label>
                        <div class="col-sm-12 {{ $errors->has('label')?'has-error':'' }}">
                            {!! Form::text('label', null, ['class' => 'form-control', 'required', 'placeholder' => 'Enter the label', ]) !!}
                            @if($errors->has('label'))
                                <label class="has-error" for="label">{{ $errors->first('label') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group row col-sm-12">
                        <label class="col-sm-12 col-form-label is_required"><b>Menu Class</b> <span class="required" style="color: red;">*</span></label>
                        <div class="col-sm-12 {{ $errors->has('class')?'has-error':'' }}">
                            {!! Form::text('class', null, ['class' => 'form-control', 'required', 'placeholder' => 'Enter custom css class' ]) !!}
                            @if($errors->has('class'))
                                <label class="has-error" for="class">{{ $errors->first('class') }}</label>
                            @endif
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group row col-sm-12">
                        <label class="col-sm-12 col-form-label is_required">
                            <b>Icon</b> <span class="required" style="color: red;">*</span> <br>
                            <small>Place FontAwesomeIcons only <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">Get FontAwesomeIcons from here</a>.</small>
                        </label>
                        <div class="col-sm-12 {{ $errors->has('icon')?'has-error':'' }}">
                            {!! Form::text('icon', null, ['class' => 'form-control', 'required', 'placeholder' => 'Enter fontawesome icon' ]) !!}
                            @if($errors->has('icon'))
                                <label class="has-error" for="icon">{{ $errors->first('icon') }}</label>
                            @endif
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group row col-sm-12">
                        <label class="col-sm-12 col-form-label is_required"><b>Target</b> <span class="required" style="color: red;">*</span></label>
                        <div class="col-sm-12 {{ $errors->has('target')?'has-error':'' }}">
                            {!! Form::select('target', $data, null, ['class' => 'form-control', 'required', ]) !!}
                            @if($errors->has('target'))
                                <label class="has-error" for="text">{{ $errors->first('target') }}</label>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-menu-changes">Save changes</button>
            </div>
        </div>
    </div>
</div>

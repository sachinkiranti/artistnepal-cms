@php $random = mt_rand(1000000, 9999999); @endphp
<tr class="team-row" data-index="{{ $random }}">
    <td colspan="3">
        <p class="pull-right">
            <a href="#" class="btn btn-danger btn-xs delete-a-team-section" title="Remove the team section"><i class="fa fa-trash-o"></i></a>
        </p>

        <div class="form-group row">
            <label class="col-sm-12 col-form-label is_required">Label <span class="required">*</span></label>
            <div class="col-sm-12 {{ $errors->has('team_label') ? 'has-error' : '' }}">
                {!! Form::text('teams[label]['. $random .'][]', null, [ 'class' => 'form-control team-label', 'placeholder' => 'Enter the team label', ]) !!}
                @if($errors->has('team_label'))
                    <label class="has-error" for="team_label">{{ $errors->first('team_label') }}</label>
                @endif
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <p class="pull-right">
            <a href="#" class="btn btn-primary btn-xs add-team" title="Add the team"><i class="fa fa-plus"></i></a>
        </p>
        <br>
        <div class="hr-line-dashed"></div>

        <div class="team-tr-manager">
            <div class="form-group row team-tr-row">
                <label class="col-sm-12 col-form-label is_required">Team  Name <span class="required">*</span></label>

                <div class="col-sm-11">
                    {!! Form::text('teams[name]['. $random .'][]', null, [ 'class' => 'form-control team-name', 'placeholder' => 'Enter the team name', ]) !!}

                    @if($errors->has('title'))
                        <label class="has-error" for="title">{{ $errors->first('title') }}</label>
                    @endif
                </div>

                <div class="col-sm-1">
                    <a href="#" class="btn btn-danger pull-left btn-xs delete-team" title="Remove the team"><i class="fa fa-trash-o"></i></a>
                </div>
            </div>
        </div>

    </td>
</tr>


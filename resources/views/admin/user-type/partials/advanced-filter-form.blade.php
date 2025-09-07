    <div class="row">
        <div class="col-lg-4 mt-3">
            <div class="form-group">
                <label for="name">User Name</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'User\'s Name', ]) !!}
            </div>
        </div>

        <div class="col-lg-4 mt-3">
            <div class="form-group">
                <label for="role">Role</label>
                {!! Form::select('role', $data['roles'], null, ['placeholder' => 'Select Role', 'class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-lg-4 mt-3">
            <div class="form-group">
                <label for="creation">Creation Date</label>
                <div class="input-group">
                    {!! Form::date('creation_start', null, ['class' => 'form-control', ]) !!}
                    <span class="input-group-addon">to</span>
                    {!! Form::date('creation_end', null, ['class' => 'form-control', ]) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-4 mt-3">
            <div class="form-group">
                <label for="category">Includes</label>
                {!! Form::select('softdelete', \Foundation\Lib\SoftDelete::$current, null, ['class' => 'form-control', ]) !!}
            </div>
        </div>

    </div>

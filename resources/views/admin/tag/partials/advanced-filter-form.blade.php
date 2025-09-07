<div class="row">
    <div class="col-lg-4 mt-3">
        <div class="form-group">
            <label >Title</label>
            {!! Form::text('filter_title', null, ['class' => 'form-control', 'placeholder' => 'Title ', ]) !!}
        </div>
    </div>
    <div class="col-lg-4 mt-3">
        <div class="form-group">
            <label >Description</label>
            {!! Form::text('filter_description', null, ['class' => 'form-control', 'placeholder' => 'Description', ]) !!}
        </div>
    </div>
    <div class="col-lg-4 mt-3">
        <div class="form-group">
            <label >Status</label>
            {!! Form::select('filter_status', \Kiranti\Config\Status::$current, null, ['class' => 'form-control', 'placeholder' => 'Select Status' ]) !!}
        </div>
    </div>
    <div class="col-lg-4 mt-3">
        <div class="form-group">
            <label >Created At</label>
            <div class="input-group">
                {!! Form::date('from', null, ['class' => 'form-control', ]) !!}
                <span class="input-group-addon">to</span>
                {!! Form::date('to', null, ['class' => 'form-control', ]) !!}
            </div>
        </div>
    </div>
</div>


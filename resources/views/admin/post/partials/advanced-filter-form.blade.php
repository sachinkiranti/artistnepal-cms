<div class="row">
    <div class="col-lg-12 mt-3">
        <div class="form-group">
            <label >Category</label>
            {!! Form::select('filter_categories[]', $data['categories'] ?? [], null, [ 'class' => 'form-control text-capitalize category-select-multiple', 'multiple' =>'multiple', ]) !!}
        </div>
    </div>
    <div class="col-lg-4 mt-3">
        <div class="form-group">
            <label >Identifier</label>
            {!! Form::text('filter_identifier', null, ['class' => 'form-control', 'placeholder' => 'Identifier', ]) !!}
        </div>
    </div>
    <div class="col-lg-4 mt-3">
        <div class="form-group">
            <label >Title</label>
            {!! Form::text('filter_title', null, ['class' => 'form-control', 'placeholder' => 'Title ', ]) !!}
        </div>
    </div>
    <div class="col-lg-4 mt-3">
        <div class="form-group">
            <label >Status</label>
            {!! Form::select('filter_status', \Kiranti\Config\Status::$current, null, ['class' => 'form-control', 'placeholder' => 'Select Status', ]) !!}
        </div>
    </div>
    <div class="col-lg-4 mt-3">
        <div class="form-group">
            <label >Created By</label>
            {!! Form::text('filter_created_by', null, ['class' => 'form-control', 'placeholder' => 'Created By', ]) !!}
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

    <div class="col-lg-4 mt-3">
        <div class="form-group">
            <label >News Type</label>
            {!! Form::select('filter_news_type', \Foundation\Lib\PostType::$types, null, ['class' => 'form-control', 'placeholder' => 'Select Type', ]) !!}
        </div>
    </div>
</div>

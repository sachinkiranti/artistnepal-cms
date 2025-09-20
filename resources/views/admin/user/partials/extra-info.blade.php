@if(request()->is('admin/user/*'))
    <div class="ibox">
        <div class="ibox-title">
            <h5>Roles and Privileges</h5>
        </div>
        <div class="ibox-content pb-1">
            @includeIf('admin.user.partials.role')
        </div>
    </div>
@endif

<div class="ibox">
    <div class="ibox-title">
        <h5>About Yourself</h5>
    </div>
    <div class="ibox-content pb-1">
        @includeIf('admin.user.partials.about')

        <div class="hr-line-dashed"></div>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label is_required"><b>Status</b></label>
            <div class="col-sm-12">
                @includeIf('admin.common.status_radio')
            </div>
        </div>
    </div>
</div>

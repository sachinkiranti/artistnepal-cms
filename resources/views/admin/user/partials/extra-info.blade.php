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
    </div>
</div>

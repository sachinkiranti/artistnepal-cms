<div class="sidebar-title">
    <h3><i class="fa fa-gears"></i> Settings</h3>
{{--    <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>--}}
</div>

<div class="setings-item">
    <small>
        <b>Clear Cache</b>
    </small>
    <a href="{{ route('admin.quick-settings', [ 'pattern' => \Foundation\Lib\QuickSetting::PATTERN_CLEAR_CACHE, ]) }}" class="pull-right btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
</div>

<div class="setings-item">
    <small>
        <b>Clear Log</b>
    </small>
    <a href="{{ route('admin.quick-settings', [ 'pattern' => \Foundation\Lib\QuickSetting::PATTERN_CLEAR_LOG, ]) }}" class="pull-right btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
</div>

<div class="setings-item">
    <small>
        <b>Clear View</b>
    </small>
    <a href="{{ route('admin.quick-settings', [ 'pattern' => \Foundation\Lib\QuickSetting::PATTERN_CLEAR_VIEW, ]) }}" class="pull-right btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
</div>

<div class="setings-item">
    <small>
        <b>Force Logout All Users</b>
    </small>
    <a href="{{ route('admin.quick-settings', [ 'pattern' => \Foundation\Lib\QuickSetting::PATTERN_CLEAR_VIEW, ]) }}" class="pull-right btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
</div>

<div class="setings-item">
    @php
        $facebook = \Foundation\Builders\Cache\Meta::get('disable_facebook_comment_globally');
        $pattern  = $facebook ? \Foundation\Lib\QuickSetting::PATTERN_ENABLE_FACEBOOK_COMMENT : \Foundation\Lib\QuickSetting::PATTERN_DISABLE_FACEBOOK_COMMENT;
    @endphp
    <small>
        <b>{{ $facebook ? 'Enable' : 'Disable' }} Facebook Comment</b>
    </small>
    <a href="{{ route('admin.quick-settings', [ 'pattern' => $pattern, ]) }}" class="pull-right btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
</div>

<div class="setings-item">
    @php
        $disqus = \Foundation\Builders\Cache\Meta::get('disable_disqus_comment_globally');
        $pattern  = $disqus ? \Foundation\Lib\QuickSetting::PATTERN_ENABLE_DISQUS_COMMENT : \Foundation\Lib\QuickSetting::PATTERN_DISABLE_DISQUS_COMMENT;
    @endphp
    <small>
        <b>{{ $disqus ? 'Enable' : 'Disable' }} Disqus Comment</b>
    </small>
    <a href="{{ route('admin.quick-settings', [ 'pattern' => $pattern, ]) }}" class="pull-right btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
</div>

<div class="setings-item">
    @php
        $siteComment = \Foundation\Builders\Cache\Meta::get('disable_site_comment_globally');
        $pattern  = $siteComment ? \Foundation\Lib\QuickSetting::PATTERN_ENABLE_SITE_COMMENT : \Foundation\Lib\QuickSetting::PATTERN_DISABLE_SITE_COMMENT;
    @endphp
    <small>
        <b>{{ $siteComment ? 'Enable' : 'Disable' }} Site Comment</b>
    </small>
    <a href="{{ route('admin.quick-settings', [ 'pattern' => $pattern, ]) }}" class="pull-right btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
</div>

<div class="setings-item">
    @php
        $reaction = \Foundation\Builders\Cache\Meta::get('disable_site_reaction_globally');
        $pattern  = $reaction ? \Foundation\Lib\QuickSetting::PATTERN_ENABLE_REACTION : \Foundation\Lib\QuickSetting::PATTERN_DISABLE_REACTION;
    @endphp
    <small>
        <b>{{ $reaction ? 'Enable' : 'Disable' }} Reaction Feedback</b>
    </small>
    <a href="{{ route('admin.quick-settings', [ 'pattern' => $pattern, ]) }}" class="pull-right btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
</div>

<div class="setings-item">
    @php
        $share = \Foundation\Builders\Cache\Meta::get('disable_site_share_globally');
        $pattern  = $share ? \Foundation\Lib\QuickSetting::PATTERN_ENABLE_SHARE : \Foundation\Lib\QuickSetting::PATTERN_DISABLE_SHARE;
    @endphp
    <small>
        <b>{{ $share ? 'Enable' : 'Disable' }} Share</b>
    </small>
    <a href="{{ route('admin.quick-settings', [ 'pattern' => $pattern, ]) }}" class="pull-right btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
</div>

<div class="setings-item">
    <small><b>Select default language</b></small> <br>
    <select class="form-control" name="language" id="language">
        <option {{ active_lang() === 'en' ? 'selected' : ''}} value="en">English</option>
        <option {{ active_lang() === 'np' ? 'selected' : ''}} value="np">Nepali</option>
    </select>
</div>

<div class="sidebar-content">
    <h4>Settings</h4>
    <div class="small">
        <b>Quick settings for the whole website. <i class="fa fa-smile-o"></i> Many options on here will be used globally .</b>
    </div>
</div>

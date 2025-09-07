@hasaccess('admin_dashboard_index')
    <li class="@isurl('admin/dashboard*') active @endisurl">
        <a href="{{ route('admin.dashboard.index') }}">
            <i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span>
        </a>
    </li>
@endhasaccess

@hasaccess('admin_post_index')
<li class="@isurl('admin/post*') active @endisurl">
    <a href="{{ route('admin.post.index') }}">
        <i class="fa fa-newspaper-o"></i><span class="nav-label">Post </span></a>
</li>
@endhasaccess

@hasaccess('admin_media_manager')
<li class="@isurl('admin/media/manager|admin/gallery*') active @endisurl">
    <a href="#">
        <i class="fa fa-file-image-o"></i> <span class="nav-label">Media</span><span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level @isurl('admin/media/manager|admin/gallery*') collapse in @else collapse @endisurl">

        @hasaccess('admin_media_manager')
        <li class="@isurl('admin/media/manager') active @endisurl">
            <a href="{{ route('admin.media.manager') }}">
                <span class="nav-label">Library </span></a>
        </li>
        @endhasaccess

        @hasaccess('admin_gallery_index')
        <li class="@isurl('admin/gallery*') active @endisurl">
            <a href="{{ route('admin.gallery.index') }}">
                <span class="nav-label">Gallery </span></a>
        </li>
        @endhasaccess
    </ul>
</li>
@endhasaccess

@hasaccess('admin_category_index')
<li class="@isurl('admin/category*') active @endisurl">
    <a href="{{ route('admin.category.index') }}">
        <i class="fa fa-th-list"></i><span class="nav-label">Category </span></a>
</li>
@endhasaccess

@hasaccess('admin_tag_index')
<li class="@isurl('admin/tag*') active @endisurl">
    <a href="{{ route('admin.tag.index') }}">
        <i class="fa fa-tags"></i><span class="nav-label">Tag </span></a>
</li>
@endhasaccess

@hasaccess('admin_comment_index|admin_reaction_index')
<li class="@isurl('admin/comment*|admin/reaction*') active @endisurl">
    <a href="#">
        <i class="fa fa-bell"></i><span class="nav-label">Feedback</span><span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level @isurl('admin/comment*|admin/reaction*') collapse in @else collapse @endisurl">
        @hasaccess('admin_comment_index')
        <li class="@isurl('admin/comment*') active @endisurl">
            <a href="{{ route('admin.comment.index') }}">
                <span class="nav-label">Comment</span></a>
        </li>
        @endhasaccess

        @hasaccess('admin_reaction_index')
        <li class="@isurl('admin/reaction*') active @endisurl">
            <a href="{{ route('admin.reaction.index') }}">
                <span class="nav-label">Reaction</span></a>
        </li>
        @endhasaccess
    </ul>
</li>
@endhasaccess

@hasaccess('admin_user_index|admin_role_index|admin_permission_index|admin_user-type_index')
    <li class="@isurl('admin/user*|admin/role*|admin/permission*|admin/user-type*') active @endisurl">
        <a href="#">
            <i class="fa fa-users"></i><span class="nav-label">User & Access </span><span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level @isurl('admin/user*|admin/role*|admin/permission*|admin/user-type*|admin/employer*|admin/job-seeker*') collapse in @else collapse @endisurl">

            @php
                $adminConst = \Foundation\Lib\Role::ROLE_ADMIN;
                $artistConst = \Foundation\Lib\Role::ROLE_ARTIST;
                $subscriberConst = \Foundation\Lib\Role::ROLE_SUBSCRIBER;
                $authorConst = \Foundation\Lib\Role::ROLE_AUTHOR;
            @endphp

            @hasaccess('admin_user-type_index')
            <li @class([ 'active' => request()->is('admin/user-type/'. $adminConst), ])>
                <a href="{{ route('admin.user-type.index', $adminConst) }}">
                    <span class="nav-label">Admin </span></a>
            </li>

            <li @class([ 'active' => request()->is('admin/user-type/'. $authorConst), ])>
                <a href="{{ route('admin.user-type.index', $authorConst) }}">
                    <span class="nav-label">Author </span></a>
            </li>

            <li @class([ 'active' => request()->is('admin/user-type/'. $artistConst), ])>
                <a href="{{ route('admin.user-type.index', $artistConst) }}">
                    <span class="nav-label">Artist </span></a>
            </li>

            <li @class([ 'active' => request()->is('admin/user-type/'. $subscriberConst), ])>
                <a href="{{ route('admin.user-type.index', $subscriberConst) }}">
                    <span class="nav-label">Subscriber </span></a>
            </li>
            @endhasaccess

            <hr style="background: #FFF;">

            @hasaccess('admin_user_index')
                <li class="@isurl('admin/user*') active @endisurl">
                    <a href="{{ route('admin.user.index') }}">
                        <span class="nav-label">User </span></a>
                </li>
            @endhasaccess

            @hasaccess('admin_role_index')
                <li class="@isurl('admin/role*') active @endisurl">
                    <a href="{{ route('admin.role.index') }}">
                        <span class="nav-label">Role </span></a>
                </li>
            @endhasaccess

            @hasaccess('admin_permission_index')
                <li class="@isurl('admin/permission*') active @endisurl">
                    <a href="{{ route('admin.permission.index') }}">
                        <span class="nav-label">Permission </span></a>
                </li>
            @endhasaccess

        </ul>
    </li>
@endhasaccess

@hasaccess('admin_email-template_index|admin_email-pattern_index')
<li class="@isurl('admin/email*') active @endisurl">
    <a href="#">
        <i class="fa fa-envelope-o"></i><span class="nav-label">Email</span><span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level @isurl('admin/email-template*|admin/email-pattern*') collapse in @else collapse @endisurl">
        @hasaccess('admin_email-template_index')
        <li class="@isurl('admin/email-template*') active @endisurl">
            <a href="{{ route('admin.email-template.index') }}">
                <span class="nav-label">Template</span></a>
        </li>
        @endhasaccess

        @hasaccess('admin_email-pattern_index')
        <li class="@isurl('admin/email-pattern*') active @endisurl">
            <a href="{{ route('admin.email-pattern.index') }}">
                <span class="nav-label">Pattern</span></a>
        </li>
        @endhasaccess
    </ul>
</li>
@endhasaccess

@hasaccess('admin_email-template_index|admin_email-pattern_index')
<li class="@isurl('admin/menu*|admin/customizer*') active @endisurl">
    <a href="#">
        <i class="fa fa-paint-brush"></i><span class="nav-label">Appearance</span><span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level @isurl('admin/menu*|admin/customizer*|admin/wrapper*') collapse in @else collapse @endisurl">
        @hasaccess('admin_menu_index')
        <li class="@isurl('admin/menu*') active @endisurl">
            <a href="{{ route('admin.menu.index') }}">
                <span class="nav-label">Menu</span></a>
        </li>
        @endhasaccess

        @hasaccess('admin_customizer_index')
        <li class="@isurl('admin/customizer*') active @endisurl">
            <a href="{{ route('admin.customizer.index') }}">
                <span class="nav-label">Customizer</span></a>
        </li>
        @endhasaccess

        @hasaccess('admin_wrapper_index')
        <li class="@isurl('admin/wrapper*') active @endisurl">
            <a href="{{ route('admin.wrapper.index') }}">
                <span class="nav-label">Component Wrapper</span></a>
        </li>
        @endhasaccess
    </ul>
</li>
@endhasaccess

@hasaccess('admin_setting_edit')
    <li class="@isurl('admin/setting*') active @endisurl">
        <a href="{{ route('admin.setting.edit') }}"><i class="fa fa-cog" aria-hidden="true"></i>
            <span class="nav-label">Setting</span>
        </a>
    </li>
@endhasaccess

@hasaccess('admin_faq_index')
<li class="@isurl('admin/faq*') active @endisurl">
    <a href="{{ route('admin.faq.index') }}">
        <i class="fa fa-question-circle"></i> <span class="nav-label">Faq </span></a>
</li>
@endhasaccess

@if (!auth()->user()->hasAccess())
<li>
    <a target="_blank" href="{{ author_url(auth()->user()->unique_identifier) }}">
        <i class="fa fa-globe"></i> <span class="nav-label">My Web Profile</span>
    </a>
</li>
@endif

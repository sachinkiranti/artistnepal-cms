<div id="right-sidebar" class="{{ session()->has(\Foundation\Lib\QuickSetting::QUICK_SETTING) ? 'sidebar-open' : '' }}">
    <div class="sidebar-container">

        <ul class="nav nav-tabs navs-3">
            <li>
                <a class="nav-link {{ session()->has(\Foundation\Lib\QuickSetting::QUICK_SETTING) ? '' : 'active' }}" data-toggle="tab" href="#tab-1" title="Recent Feedback"> <i class="fa fa-bell"></i> </a>
            </li>
            <li>
                <a class="nav-link" data-toggle="tab" href="#tab-2" title="Statistics"> <i class="fa fa-bar-chart"></i></i> </a>
            </li>
            <li>
                <a class="nav-link {{ session()->has(\Foundation\Lib\QuickSetting::QUICK_SETTING) ? 'active' : '' }}" data-toggle="tab" href="#tab-3" title="Global Settings"> <i class="fa fa-gear"></i> </a>
            </li>
        </ul>

        <div class="tab-content">

            <div id="tab-1" class="tab-pane {{ session()->has(\Foundation\Lib\QuickSetting::QUICK_SETTING) ? '' : 'active' }}">

                @include('admin.layouts.partials.sidebar.feedback')

            </div>

            <div id="tab-2" class="tab-pane">

                @include('admin.layouts.partials.sidebar.statistics')

            </div>

            <div id="tab-3" class="tab-pane {{ session()->has(\Foundation\Lib\QuickSetting::QUICK_SETTING) ? 'active' : '' }}">

                @include('admin.layouts.partials.sidebar.settings')

            </div>
        </div>

    </div>

</div>

<div class="sidebar-title">
    <h3> <i class="fa fa-area-chart"></i> Statistics</h3>
</div>

<ul class="sidebar-list">
    <li>
        <div class="small float-right m-t-xs"><b>0.1.0</b></div>
        <h4>Version</h4>
    </li>

    <li>
        <div class="small float-right m-t-xs"><b>{{ number_format((microtime(true) - LARAVEL_START), 2, '.', '') }} seconds</b></div>
        <h4>Server Response Time</h4>
    </li>

    <li>
        <div class="small float-right m-t-xs"><b>{{ optional(auth()->user()->last_login)->diffForHumans() }} </b></div>
        <h4>Time Spent On App</h4>
    </li>

    <li>
        <div class="small float-right m-t-xs"><b>{{ number_format((float) database_size(), 2, '.', '') }} MB</b></div>
        <h4>Database size</h4>
    </li>

    <li>
        <div class="small float-right m-t-xs"><b>{{ log_file_size() }}</b></div>
        <h4>Log File size</h4>
    </li>
</ul>

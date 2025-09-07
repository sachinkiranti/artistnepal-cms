<div class="ibox ibox-wrapper-custom">
    <div class="ibox-title ibox-card-custom pr-2">
        <h4 class="d-inline">{{ $title }}</h4>
        <select class="float-right totalSelect" >
            <option value="1">All</option>
            <option value="2">Today</option>
            <option value="3">This Week</option>
            <option value="4">This Month</option>
            <option value="5">This Year</option>
        </select>
    </div>
    {{ $slot }}
</div>

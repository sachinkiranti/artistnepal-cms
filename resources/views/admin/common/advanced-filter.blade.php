<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title ibox-title-border pr-4">
                <h5> <i class="fa fa-filter"></i> &nbsp; Filter</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="ibox-content ibox-content-custom" style="display: none">

                <form action="#" id="filter-form">
                    {{ $slot }}

                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <button id="filter-btn" class="btn btn-sm btn-primary float-right">
                                <strong><i class="fa fa-filter"></i> Filter</strong>
                            </button>
                            <button class="btn btn-sm btn-danger float-right" id="reset-btn" style="margin-right: 10px;">
                                <strong>Reset</strong>
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

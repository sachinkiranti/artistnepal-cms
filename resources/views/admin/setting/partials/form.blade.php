<div class="row">
    <div class="col-lg-12">
        <div class="ibox" style="margin: 10px;">
            <div class="tabs-container">
                <div class="tabs-left">
                    <ul class="nav nav-tabs text-center" role="tablist" style="background: #fff;">
                        <li>
                            <a class="nav-link active show" data-toggle="tab" href="#general">
                                <i class="fa fa-2x fa-home"></i> <br> General
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" data-toggle="tab" href="#config">
                                <i class="fa fa-2x fa-cog"></i> <br> Config
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" data-toggle="tab" href="#social">
                                <i class="fa fa-2x fa-globe"></i> <br> Social
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" data-toggle="tab" href="#seo">
                                <i class="fa fa-2x fa-search"></i> <br> SEO
                            </a>
                        </li>
                    </ul>


                    <div class="tab-content">
                        <div role="tabpanel" id="general" class="tab-pane active show">
                            <div class="panel-body">
                                @include('admin.setting.partials.general_info')
                            </div>
                        </div>

                        <div role="tabpanel" id="config" class="tab-pane">
                            <div class="panel-body" style="min-height: 200px;">
                                @include('admin.setting.partials.config')
                            </div>
                        </div>

                        <div role="tabpanel" id="social" class="tab-pane">
                            <div class="panel-body">
                                @include('admin.setting.partials.social')
                            </div>
                        </div>

                        <div role="tabpanel" id="seo" class="tab-pane">
                            <div class="panel-body">
                                @include('admin.setting.partials.seo')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

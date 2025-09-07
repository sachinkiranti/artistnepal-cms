<div class="card">
    <div class="card-header" id="headingThree">
        <b class="mb-0">
            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree">
                <b>Custom Links</b>
            </button>
        </b>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
            @include('admin.appearance.menu.partials.menu-custom-links-form')
            <div class="form-group row col-sm-12">
                <div class="col-sm-12">
                    <button class="btn btn-xs btn-primary add-to-menu" data-menu-type="Custom Link">
                        <i class="fa fa-plus"></i> Add To Menu
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

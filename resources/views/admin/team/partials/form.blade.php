<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Team List</h5>
            </div>
            <div class="ibox-content team-manager">
                <div class="hr-line-dashed"></div>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Summary</th>
                        <th></th>
                        <th>
                            <a href="#" class="btn btn-primary btn-xs add-a-team-section" title="Add a new team section">
                                <i class="fa fa-plus"></i>
                            </a>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @isset($data['teams'])
                        @include('admin.team.partials.team-edit-tr')
                    @else
                        @include('admin.team.partials.team-tr')
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

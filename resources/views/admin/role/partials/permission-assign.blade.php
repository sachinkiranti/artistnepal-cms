@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <style>
        .custom-cb{
            position: relative;
        }
        .custom-cb::before
        {
            content: "";
            position: absolute;
            left: -19px;
            /*right: 0;*/
            top: 50%;
            transform: rotate(-45deg) translateY(calc(-50% - 2px));
            opacity: 0;
            z-index: 1;
            width: 10px;
            height: 5px;
            border-color: #58b3f0;
            border-style: none none solid solid;
            border-width: 2px;
        }
        .custom-cb::after
        {
            content: "";
            position: absolute;
            left: -25px;
            /*right: 0;*/
            /*bottom: 0;*/
            top: 50%;
            transform: translateY(-50%);
            margin: auto;
            width: 16px;
            height: 16px;
            background: #fff;
            border: 1px solid #c4cdd5;
            cursor: pointer;
            border-radius: 3px;

        }
        .custom-cb-input{
            opacity: 0;
            pointer-events: none;
        }
        .custom-cb-input:checked + .custom-cb::before{
            opacity: 1;
        }
        .permissionWrapperBody input
        {
            margin-right: 10px !important;
            cursor: pointer;
        }
        .permissionWrapperBody ul li:first-child
        {
            margin-top:8px;
        }
        .permissionWrapperBody ul li
        {
            list-style: none;
            padding: 0 0 8px 0;
        }

        .label
        {
            text-shadow: none!important;
            font-size: 14px !important;
            border-radius: 0 !important;
            font-weight: 300;
            padding: 6px 8px;
            color: #fff;
            font-family: Roboto,sans-serif;
        }
        .label-default {
            background-color: #1ab392;
        }
        .label-warning {
            background-color: #1ab392;
        }
        .label-primary {
            background-color: #337ab7;
        }
        .access-border {
            border-left: 1px dashed #000000;
        }
    </style>
@endpush

<div class="hr-line-dashed"></div>
<div class="permissionWrapperBody">
    <input type="checkbox" id="allPermission" class="allPermission custom-cb-input" >
    <label  class="label label-default custom-cb" for="allPermission">All Permissions</label>
    <ul class="access-border">
        @forelse($data['permissions'] as $name => $actions)
            <li>
                <input type="checkbox" id="{{ $name }}" class="subPermission custom-cb-input" >
                <label class="label label-warning custom-cb" for="{{ $name }}" >{{ ucfirst($name) }}</label>
                <ul class="subMenu access-border" style="display: none">
                    @forelse($actions as $action)
                        <li class="actionMenu">
                            <input id ="{{ $name }}_{{ $action->action }}"
                                   type="checkbox"
                                   class="action custom-cb-input"
                                   name="permissions[]"
                                   value="{{ $action->permission_id }}"
                            @isset($data['role_permissions']) {{ $data['role_permissions'] ? (in_array($action->permission_id, array_column($data['role_permissions'], 'id')) ? 'checked' : '') : '' }} @endisset
                            >
                            <label for="{{ $name }}_{{ $action->action }}" class="action label label-primary custom-cb" >{{ ucfirst($action->action) }}</label>
                        </li>
                    @empty
                        <b>No Actions</b>
                    @endforelse
                </ul>
            </li>
        @empty
            <p>No Permissions</p>
        @endforelse
    </ul>
</div>

@push('js')

@endpush

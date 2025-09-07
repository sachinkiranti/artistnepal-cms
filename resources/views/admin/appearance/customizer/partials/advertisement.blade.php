<div class="ibox">
    <div class="ibox-title ibox-title-border">
        <h5>Top Advertisement</h5>
    </div>

    <div class="ibox-content ibox-content-custom">
        <div class="table-responsive">

            <div class="hr-line-dashed"></div>

            <table class="table">
                <tr>
                    <th style="width: 50%;">Ad Image</th>
                    <th>Url</th>
                    <th>
                        <a href="#" class="btn btn-xs btn-primary add-advertisement">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                </tr>

                @if (isset($topAds) && ! empty($topAds))

                    @foreach($topAds as $image => $caption)

                        @include('admin.appearance.customizer.widgets.partials.advertisement-row', [
                            'widgetId' => $widgetId ?? '',
                            'image'    => $image,
                            'caption'  => $caption,
                            'position' => 'top',
                        ])

                    @endforeach

                @else

                    @include('admin.appearance.customizer.widgets.partials.advertisement-row', [
                        'widgetId' => $widgetId ?? '',
                        'position' => 'top',
                    ])

                @endif

            </table>
        </div>
    </div>
</div>

<div class="ibox">
    <div class="ibox-content ibox-content-custom">
        <div class="hr-line-dashed"></div>

        <p><b>{{ __('Widget') }}</b> <code class="uppercase">{{ $widgetId ?? '' }}</code></p>

        <p><b>{{ $widgetTitle ?? '' }}</b></p>
        <p>{{ $widgetDesc ?? '' }}</p>

        <div class="hr-line-dashed"></div>
    </div>
</div>

<div class="ibox">
    <div class="ibox-title ibox-title-border">
        <h5>Bottom Advertisement</h5>
    </div>

    <div class="ibox-content ibox-content-custom">
        <div class="table-responsive">

            <div class="hr-line-dashed"></div>

            <table class="table">
                <tr>
                    <th style="width: 50%;">Ad Image</th>
                    <th>Url</th>
                    <th>
                        <a href="#" class="btn btn-xs btn-primary add-advertisement"><i class="fa fa-plus"></i></a>
                    </th>
                </tr>

                @if (isset($bottomAds) && ! empty($bottomAds))

                    @foreach($bottomAds as $image => $caption)

                        @include('admin.appearance.customizer.widgets.partials.advertisement-row', [
                            'widgetId' => $widgetId ?? '',
                            'image'    => $image,
                            'caption'  => $caption,
                            'position' => 'bottom',
                        ])

                    @endforeach

                @else

                    @include('admin.appearance.customizer.widgets.partials.advertisement-row', [
                        'widgetId' => $widgetId ?? '',
                        'position' => 'bottom',
                    ])

                @endif
            </table>
        </div>
    </div>

</div>

<div class="foot-panel">
    <h4>हिमालय मिडिया टिम</h4>
    <div class="foot-box">

        @php $labels = $teams->get('label'); @endphp
        @if(isset($teams) && isset($labels))
        @foreach($labels as $key => $value)
        <div class="team-box">
            <h4>{{ $teams['label'][$key][0] ?? '' }}</h4>
            @isset($teams['name'][$key])
                <ul>
                    @foreach($teams['name'][$key] as $index  => $team)
                        <li>{!! $team !!}</li>
                    @endforeach
                </ul>
            @endisset
        </div>
        @endforeach
        @endif
    </div>
</div>

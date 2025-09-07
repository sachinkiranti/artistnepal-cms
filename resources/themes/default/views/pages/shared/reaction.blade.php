<div class="emo-response">
    <h4>{{ __('यो खबर पढेर तपाईलाई कस्तो महसुस भयो ?') }}</h4>
    <ul class="list-motion">
        @foreach ($data['reactions'] as $key => $value)

            @php
                $reaction = strtolower($value);
                $reactionPercentage = $reaction . '_percentage';
            @endphp

            <li class="feedback-reaction-wrapper" data-identifier="{{ $data['post']->unique_identifier }}">
                <div class="motion-box">
                    <div class="emo-img">
                        <span class="badge reaction-percentage-{{ $key }}">{{ (int) $data['reaction-summary']->$reactionPercentage }}%</span>
                        <span class="emoji emoji-{{ $key }} do-react"
                              data-reaction="{{ $key }}"
                              data-identifier="{{ $data['post']->unique_identifier }}"
                              style="background-image: url({{ asset('images/frontend/'.$reaction.'.svg') }})">
                        </span>
                    </div>
                    <span class="motion-text reaction-text-{{ $key }}">{{ $value }}</span>
                </div>
            </li>
        @endforeach

    </ul>
</div>

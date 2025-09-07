@include('pages.shared.advertisement', [
    'class'            => 'adv adv-full',
    'advertisements'   => $bottomAdvertisements ?? null,
    'index'            => $index ?? 0,
    'type'             => 'bottom',
])

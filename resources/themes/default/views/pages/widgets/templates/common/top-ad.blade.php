@include('pages.shared.advertisement', [
    'class'    => 'adv adv-full',
    'advertisements'   => $topAdvertisements ?? null,
    'index'            => $index ?? 0,
    'type'             => 'top',
])

<?php

namespace Foundation\Handlers;

use Foundation\Services\SettingService;

/**
 * Class Meta
 * @package Foundation\Handlers
 */
final class Meta
{

    private const META_PREFIX = 'site-';

    private const META_MAPPER = [
        'site-name'     => 'company',
        'site-logo'     => 'logo',
    ];

    private const FUNC_MAPPER = [
        'logo' => 'retrieveLogo'
    ];

    private $settingService;

    public function __construct( SettingService $settingService )
    {
        $this->settingService = $settingService;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public function handler(string $key)
    {
        $key = static::META_MAPPER[$key] ?? str_replace(static::META_PREFIX, '', $key);

        $meta = $this->settingService->byKey($key);

        if ($key == 'logo') {
            return $this->retrieveLogo($meta);
        }
        return $meta;
    }

    private function retrieveLogo($image)
    {
        if ($image) { asset('images/admin/default.jpg'); }
        return asset( 'storage/images/setting/'.$image);
    }

}

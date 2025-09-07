<?php

namespace Foundation\Services;

use Exception;
use Foundation\Builders\Cache\Meta;
use Foundation\Models\Setting;
use Kiranti\Config\Language;
use Kiranti\Supports\Concerns\Image;
use Foundation\Lib\Setting as Option;
use Illuminate\Database\DatabaseManager;

/**
 * Class SettingService
 * @package Foundation\Services
 */
class SettingService
{
    use Image;

    /**
     * The settings folder to store photo
     *
     * @var string
     *
     */

    protected $folder = 'setting';


    /**
     * The Setting instance
     *
     * @var $model
     */
    protected $model;

    /**
     * @var DatabaseManager
     */
    private $database;

    /**
     * SettingService constructor.
     * @param Setting $setting
     * @param DatabaseManager $databaseManager
     */
    public function __construct(Setting $setting, DatabaseManager $databaseManager)
    {
        $this->model = $setting;
        $this->database = $databaseManager;
    }

    /**
     * Update the website settings
     *
     * @param array $data
     * @return bool|mixed|void
     * @throws \Exception
     */
    public function update(array $data)
    {
        try {
            $this->database->beginTransaction();
            if (isset($data['photo'])){
                $logo_row = $this->model->where('key', 'logo')->first();

                $this->model->updateOrCreate([ 'key' => 'logo', ], [ 'value' => $this->uploadImage($data['photo'], $this->folder, optional($logo_row)->value), ]);
            }

            unset($data['photo']);

            if (isset($data['homepage_popup_ads_holder'])){
                $homepage_popup_ads = $this->model->where('key', 'homepage_popup_ads')->first();

                $this->model
                    ->updateOrCreate([ 'key' => 'homepage_popup_ads', ],
                        [ 'value' => $this->uploadImage($data['homepage_popup_ads_holder'], $this->folder, optional($homepage_popup_ads)->value), ]);
            }

            unset($data['homepage_popup_ads_holder']);

            if (isset($data['single_page_ads_holder'])){
                $single_page_popup_ads = $this->model->where('key', 'single_page_popup_ads')->first();

                $this->model
                    ->updateOrCreate([ 'key' => 'single_page_popup_ads', ],
                        [ 'value' => $this->uploadImage($data['single_page_ads_holder'], $this->folder, optional($single_page_popup_ads)->value), ]);
            }

            unset($data['single_page_ads_holder']);

            if (isset($data['social_homepage'])){
                $social_homepage_image = $this->model->where('key', 'social_homepage_image')->first();

                $this->model
                    ->updateOrCreate([ 'key' => 'social_homepage_image', ],
                        [ 'value' => $this->uploadImage($data['social_homepage'], $this->folder, optional($social_homepage_image)->value), ]);
            }

            unset($data['social_homepage']);

            foreach ($data as $key => $value) {
                $this->model->updateOrCreate([ 'key' => $key, ], [
                    'key'        => $key,
                    'value'      => is_iterable($value) ? json_encode($value) : $value,
                    'updated_by' => auth()->id(),
                ]);
            }

            $this->database->commit();
            return true;
        } catch (Exception $exception) {
            $this->database->rollBack();
            return;
        }
    }

    /**
     * Get the settings in array format
     *
     * @return mixed
     */
    public function getSettings()
    {
        $data = [];
        foreach ($this->pluckToArray() as $key => $value) {
            $data[$key] = is_json($value) ? json_decode($value, 1) : $value;
        }
        return $data;
    }

    /**
     * Get the settings from database
     *
     * @return mixed
     */
    public function pluckToArray()
    {
        return $this->model->pluck('value','key')->toArray();
    }

    /**
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public function byKey(string $key)
    {
        return Meta::get($key);
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getTeams()
    {
        $value = $this->byKey('teams');
        return collect(is_json($value) ? json_decode($value, 1) : $value);
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws Exception
     */
    public function getWrappers()
    {
        $value = $this->byKey((active_lang() === 'en' ? 'en-' : '').'wrappers');
        return collect(is_json($value) ? json_decode($value, 1) : $value);
    }

    /**
     * @param array $wrappers
     * @return \Illuminate\Support\Collection
     * @throws Exception
     */
    public function updateComponentWrappers(array $wrappers)
    {
        $key = (active_lang() === 'en' ? 'en-' : '').'wrappers';
        return $this->model->where('key', $key)->update([
            'value' => json_encode($wrappers)
        ]);
    }

    /**
     * @param array $advertisements
     * @return mixed
     */
    public function addOrUpdateWrapperAdvertisement(array $advertisements)
    {
        $key = (active_lang() === 'en' ? 'en-' : '').'wrappers-advertisement';
        return $this->model->updateOrCreate([ 'key' => $key, ], [
            'value' => json_encode($advertisements)
        ]);
    }

    public function getWrappersAdvertisements()
    {
        $key = (active_lang() === 'en' ? 'en-' : '').'wrappers-advertisement';
        return json_decode($this->model->where('key', $key)->value('value'), 1);
    }

}

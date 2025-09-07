<?php

namespace App\Http\Controllers\Frontend;

use Foundation\Services\GalleryService;

/**
 * Class GalleryController
 *
 * @package App\Http\Controllers\Frontend
 */
final class GalleryController extends BaseController
{

    /**
     * @var GalleryService
     */
    private $galleryService;

    /**
     * GalleryController constructor.
     *
     * @param GalleryService $galleryService
     */
    public function __construct( GalleryService $galleryService )
    {
        $this->galleryService = $galleryService;
    }

    public function __invoke($uniqueIdentifier = null)
    {
        if ($uniqueIdentifier) {
            $data['gallery']  = $this->galleryService->query()->where('unique_identifier', $uniqueIdentifier)->firstOrFail();
            $data['pictures'] = $this->galleryService->getPictures($data['gallery']->id);
        } else {
            $data['gallery']  = $this->galleryService->query()
                ->limit(10)
                ->get();
        }

        return view('pages.gallery', compact('data', 'uniqueIdentifier'));
    }

}

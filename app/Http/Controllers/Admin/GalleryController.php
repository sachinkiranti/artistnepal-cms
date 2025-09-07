<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Foundation\Lib\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Foundation\Lib\Utility;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Foundation\Models\Gallery;
use Kiranti\Supports\BaseController;
use Kiranti\Supports\Concerns\Image;
use Foundation\Requests\Gallery\{
    StoreRequest,
    UpdateRequest
};
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Foundation\Services\GalleryService;

/**
 * Class GalleryController
 * @package App\Http\Controllers\Admin
 */
class GalleryController extends BaseController
{

    use Image;

    /**
     * The GalleryService instance
     *
     * @var $galleryService
     */
    private $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->galleryService->filter($request->input('search.value')))
                ->addColumn('created_at', function ($data) {
                    return $data->created_at . ' <code>'.optional($data->created_at)->diffForHumans().'</code>';
                })
                ->addColumn('thumbnail', function ($data) {
                    return view('admin.gallery.partials.image', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    $model = 'gallery';
                    return view('admin.common.data-table-action', compact('data', 'model'))->render();
                })
                ->addColumn('status', function ($data) {
                     return view('admin.common.status', compact('data'))->render();
                })
                ->addColumn('created_by', function ($data) {
                    return optional($data)->author_full_name;
                })
                ->addColumn('checkbox', function ($data) {
                    return view('admin.common.checkbox', compact('data'))->render();
                })
                ->rawColumns([ 'checkbox', 'thumbnail', 'action', 'created_at', 'status', ])
                ->make(true);
        }

        return view('admin.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory
     */
    public function create()
    {
        $data = [];
        //
        return view('admin.gallery.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        if ($request->hasFile('image_holder')) {
            $request->merge([
                'thumbnail' => $this->uploadImage($request->file('image_holder'), 'gallery'),
                'created_by' => auth()->id(),
            ]);
        }

        $gallery = $this->galleryService->new($request->merge([
            'slug' => Str::slug($request->get('slug')). '-'.Utility::randomNumber(),
        ])->all());

        if ($gallery) {
            foreach ($request->get('image') as $key => $image) {
                app('db')
                    ->table('gallery_image')
                    ->updateOrInsert([
                        'gallery_id' => $gallery->id,
                        'title'      => $request->input('title.'.$key),
                        'image'      => $request->input('image.'.$key),
                        'caption'    => $request->input('caption.'.$key),
                    ], [ 'created_by' => auth()->id(), ]);
            }
        }
        Cache::clear();
        flash('success', 'Record successfully created.');
        return $this->redirect($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  Gallery $gallery
     * @return Factory
     */
    public function show(Gallery $gallery)
    {
        $data = [];
        $data['gallery'] = $gallery;
        $data['gallery-images'] = app('db')
            ->table('gallery_image')
            ->where('gallery_id', $gallery->id)
            ->count();
        return view('admin.gallery.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Gallery $gallery
     * @return Factory
     */
    public function edit(Gallery $gallery)
    {
        $data = [];
        $data['gallery']  = $gallery;
        $data['gallery-images'] = app('db')
            ->table('gallery_image')
            ->where('gallery_id', $gallery->id)
            ->get();
        return view('admin.gallery.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  Gallery $gallery
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Gallery $gallery)
    {
        if ($request->hasFile('image_holder')) {
            $request->merge([
                'thumbnail' => $this->uploadImage($request->file('image_holder'), 'gallery', $gallery->thumbnail),
                'created_by' => auth()->id(),
            ]);
        }
        $gallery = $this->galleryService->update($request->all(), $gallery);

        if ($gallery) {
            $lastUpdatedId = [];
            foreach ($request->get('image') as $key => $image) {
                app('db')
                    ->table('gallery_image')
                    ->updateOrInsert([
                        'gallery_id' => $gallery->id,
                        'title'      => $request->input('title.'.$key),
                        'image'      => $request->input('image.'.$key),
                        'caption'    => $request->input('caption.'.$key),
                    ], [
                        'created_by' => auth()->id(),
                    ]);

                $lastUpdatedId[] = app('db')
                    ->table('gallery_image')
                    ->where([
                        'gallery_id'    => $gallery->id,
                        'image'      => $request->input('images.'.$key),
                        'caption'    => $request->input('caption.'.$key),
                    ])->value('id');
            }

           app('db')
                ->table('gallery_image')
                ->where('gallery_id', $gallery->id)
                ->whereNotIn('id', $lastUpdatedId)
                ->delete();

        }
        Cache::clear();
        flash('success', 'Record successfully updated.');
        return $this->redirect($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gallery $gallery
     * @return RedirectResponse
     */
    public function destroy(Gallery $gallery)
    {
        $this->galleryService->delete($gallery);
        Cache::clear();
        flash('success', 'Gallery is deleted successfully !');
        return redirect()->back();
    }
}

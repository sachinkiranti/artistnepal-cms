<?php

namespace Foundation\Listeners;

use Intervention\Image\Facades\Image;
use UniSharp\LaravelFilemanager\Events\FolderWasRenamed;
use UniSharp\LaravelFilemanager\Events\ImageWasDeleted;
use UniSharp\LaravelFilemanager\Events\ImageWasRenamed;
use UniSharp\LaravelFilemanager\Events\ImageWasUploaded;

class UploadListener
{

    public function handle($event)
    {
        $method = 'on'.class_basename($event);
        if (method_exists($this, $method)) {
            call_user_func([$this, $method], $event);
        }
    }

    public function onImageWasUploaded(ImageWasUploaded $event)
    {
        $imagePath = $event->path();

        $watermarkImage = Image::make(public_path('images/default-logo.png'));

        $resizePercentage = 40; // 70% less then an actual image (play with this value)

        $watermarkSize = round($watermarkImage->width() * ((100 - $resizePercentage) / 100), 2); // watermark will be $resizePercentage less then the actual width of the image

        // resize watermark width keep height auto
        $watermarkImage->resize($watermarkSize, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $imageWithWaterMark = Image::make($imagePath);

        $imageWithWaterMark->insert($watermarkImage, 'bottom-right', 5, 5);

        $imageWithWaterMark->save($imagePath);
    }

    public function onImageWasRenamed(ImageWasRenamed $event)
    {
        // image was renamed
    }

    public function onImageWasDeleted(ImageWasDeleted $event)
    {
        // image was deleted
    }

    public function onFolderWasRenamed(FolderWasRenamed $event)
    {
        // folder was renamed
    }

}

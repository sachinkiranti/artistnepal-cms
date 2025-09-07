<?php

namespace Kiranti\Supports\Concerns;

use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

/**
 * Trait HasImage
 * @package Kiranti\Supports\Concerns
 */
trait HasImage
{

    /**
     * Will attach image for the given request
     *
     * @param $image
     * @param bool $useWaterMark
     * @param string $watermarkPosition
     * @param null $existingImage
     * @return string
     */
    public static function attachImage( $image, $useWaterMark = false, $watermarkPosition = 'bottom-right', $existingImage = null )
    {
        $imageWithWaterMark = null;

        $imageName  = static::getRandomNumber() . '.' . $image->getClientOriginalExtension();
        $folderName = static::getFolderName();

        $imagePath = 'images'.DIRECTORY_SEPARATOR.$folderName.DIRECTORY_SEPARATOR.$imageName;

        if ($useWaterMark) {
            if (!$watermarkPosition) {
                $watermarkPosition = 'bottom-right';
            } else {
                $watermarkPosition = strtolower(str_replace([' ',], '-', $watermarkPosition));
            }
            $watermarkImage = \Intervention\Image\Facades\Image::make(public_path('images/default-logo.png'));

            $watermarkSize = $watermarkImage->width() - 20; //size of the image minus 20 margins
            $watermarkSize = $watermarkImage->width() / 2; //half of the image size
            $resizePercentage = 70; //70% less then an actual image (play with this value)

            $watermarkSize = round($watermarkImage->width() * ((100 - $resizePercentage) / 100), 2); // watermark will be $resizePercentage less then the actual width of the image

            // resize watermark width keep height auto
            $watermarkImage->resize($watermarkSize, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $imageWithWaterMark = \Intervention\Image\Facades\Image::make($image->getRealPath())
                ->insert($watermarkImage, $watermarkPosition, 5, 5)
                ->encode($image->getClientOriginalExtension());
            $imageUpload = $imageWithWaterMark->__toString();
        } else {
            $imageUpload = File::get($image);
        }

        Storage::disk('public')->put($imagePath, $imageUpload);

        if ($useWaterMark) {
            static::attachThumbs($imageWithWaterMark, $imageName);
        } else {
            static::attachThumbs($imageUpload, $imageName);
        }

        if($existingImage) {
            static::deleteImages($existingImage);
        }

        return $imageName;
    }

    /**
     * Attach thumbnails
     *
     * @param $imageFile
     * @param $imageName
     */
    public static function attachThumbs($imageFile, $imageName)
    {
        foreach (static::getImageDimensions() as $dimension) {

            Storage::disk('public')->put(
                'images'.DIRECTORY_SEPARATOR . static::getFolderName() . DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $dimension['width'] . '_' . $dimension['height'] . '_' . $imageName,
                \Intervention\Image\Facades\Image::make($imageFile)
                ->resize($dimension['width'], $dimension['height'], function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode());
        }
    }

    /**
     * Delete Image with its thumbnails
     *
     * @param $image
     */
    public static function deleteImages($image)
    {
        static::deleteImage('images'. DIRECTORY_SEPARATOR .static::getFolderName(). DIRECTORY_SEPARATOR .$image);
        foreach (static::getImageDimensions() as $dimension) {
            static::deleteImage('images'. DIRECTORY_SEPARATOR .static::getFolderName(). DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR .$dimension['width'] . '_' . $dimension['height'] . '_' . $image);
        }
    }

    /**
     * Delete the given image
     *
     * @param $image
     * @return bool
     */
    public static function deleteImage($image)
    {
        if(Storage::disk('public')->has($image)) {
            Storage::disk('public')->delete($image);
            return true;
        }
        return false;
    }

    /**
     * Return random number to be prefix to the image name
     *
     * @return string
     */
    public static function getRandomNumber()
    {
        return (string) hexdec(uniqid());
    }

    /**
     * Return the image dimensions
     *
     * @return string[][]
     */
    public static function getImageDimensions()
    {
        return [
            [ 'width' => '400', 'height' => '400', ],
            [ 'width' => '200', 'height' => '200', ],
        ];
    }

    /**
     * Return the folder name
     *
     * @return string
     */
    public static function getFolderName()
    {
        return static::setFolderName();
    }

//    /**
//     * Return the image column
//     *
//     * @return string
//     */
//    public static function getImageColumn()
//    {
//        return static::setImageColumn();
//    }

    /**
     * Set the folder name
     *
     * @return string
     */
    abstract public static function setFolderName() : string;

//    /**
//     * Set the image column
//     *
//     * @return string
//     */
//    abstract public static function setImageColumn() : string;

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    /*
     * Public interface
     */
    public function resize($width, $height, $path)
    {
//        get file path
        list($imgFile, $ext) = $this->getImagePath($path);

        $img = Image::cache(function($image) use($imgFile, $width, $height) {
            $image->make($imgFile)->resize($width, $height);
        }, config('blog.imageCacheTime'), true);

        return $this->createResponse($img, $ext);
    }


    public function fit($width, $height, $path)
    {
        list($imgFile, $ext) = $this->getImagePath($path);

        $img = Image::cache(function($image) use($imgFile, $width, $height) {
            $image->make($imgFile)->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }, config('blog.imageCacheTime'), true);

        return $this->createResponse($img, $ext);
    }


    public function widen($width, $path)
    {
        list($imgFile, $ext) = $this->getImagePath($path);

        $img = Image::cache(function($image) use($imgFile, $width) {
            $image->make($imgFile)->widen($width, function ($constraint) {
                $constraint->upsize();
            });
        }, config('blog.imageCacheTime'), true);

        return $this->createResponse($img, $ext);
    }


    public function heighten($height, $path)
    {
        list($imgFile, $ext) = $this->getImagePath($path);

        $img = Image::cache(function($image) use($imgFile, $height) {
            $image->make($imgFile)->heighten($height, function ($constraint) {
                $constraint->upsize();
            });
        }, config('blog.imageCacheTime'), true);

        return $this->createResponse($img, $ext);
    }


    public function show($path)
    {
        list($imgFile, $ext) = $this->getImagePath($path);

        $img = Image::make($imgFile);

        return $this->createResponse($img, $ext, 100);
    }


    /*
     * Service methods
     */
    protected function getImagePath($path)
    {
//        get file extension
        $nameArray = explode('.', $path);
        $ext = array_pop($nameArray);

//        get file path
        $file = str_replace('.', '/', implode('.', $nameArray));
        //"5/5d8/5d8a1e5b371dd90c0b9064c6c859603d9e640994"

//        get full path
        $filePath = config('blog.uploadPath') . config('blog.imageUploadSection') . '/' . $file;

        if (!File::isFile($filePath)) {
//            show default image if file not exists
            $filePath = config('blog.imageDefaultPath');
            $ext = 'jpg';
        }

        return [$filePath, $ext];
    }


    protected function createResponse($imgObj, $ext = 'jpg', $quality = 75)
    {
        //TODO put requested file in public/img folder

        return $imgObj->response($ext, $quality)
            ->header('Cache-Control', 'public, max-age=' . config('blog.imageCacheTime', '86400'));
    }
}

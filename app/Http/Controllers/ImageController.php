<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

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
        $filePath = config('blog.uploadPath') . '/' . config('blog.imageUploadSection') . '/' . $file;

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
        /*
        $arrayName = explode('/', $this->request->path());
        array_pop($arrayName);
        $publicDir = implode('/', $arrayName);
        $publicFile = $publicDir . '/' . $imgObj->filename . '.' . $ext;

        $storeDir = substr($imgObj->filename, 0, 1) . '/' . substr($imgObj->filename, 0, 3);
        $storeFile = 'images/' . $storeDir . '/' . $imgObj->filename;

//        check if the folder already exists
        if (!File::exists($publicDir)) {

//            if not then create it
            if (!File::makeDirectory($publicDir, config('blog.storagePermissions', 0755), true)) {
                throw new \ErrorException('Не могу создать директорию ' . $publicDir);
            }
        }

//        check if the folder was created and it is writable
        if (File::isDirectory($publicDir) && File::isWritable($publicDir)) {
//            if yes then move file to the folder

            Storage::disk('uploads')->copy($storeFile, $publicFile);
        } else {
            throw new \ErrorException('Директория ' . $publicDir . ' недоступна для записи');
        }
        die;

        */


        return $imgObj->response($ext, $quality)
            ->header('Cache-Control', 'public, max-age=' . config('blog.imageCacheTime', '86400'));
    }
}

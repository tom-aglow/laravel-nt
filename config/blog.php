<?php

return [
    /*
     * Config of image uploader/downloader
     */

//    'storagePath' => storage_path() . '/app',
    'uploadPath' => storage_path() . '/uploads',
    'defaultUploadSection' => 'files',
    'imageUploadSection' => 'images',
    'docsUploadSection' => 'docs',
    'imageDefaultPath' => storage_path() . '/default.jpg',
    'storagePermissions' => 0755,
    'imageCacheTime' => 86400,

];

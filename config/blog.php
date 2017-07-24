<?php

return [
    /*
     * Config of image uploader/downloader
     */

    'uploadPath' => storage_path() . '/uploads',
    'defaultUploadSection' => 'files',
    'imageUploadSection' => 'images',
    'docsUploadSection' => 'docs',
    'imageDefaultPath' => storage_path() . '/default.jpg',
    'storagePermissions' => 0755,
    'imageCacheTime' => 86400,


    /*
     * values for comments statuses
     */
    'commentStatus' => [
        'accepted' => 'accepted',
        'new' => 'on moderation',
        'deleted' => 'deleted',
    ],

    /*
     * config for mails
     */
    'mail' => [
        'blogAuthor' => 'tom@ohhhh.me',
        'feedbackSubject' => 'New feedback in your blog',
    ],

    /*
    * values for user login/signup
    */
    'user' => [
        'role' => 'User'
    ],
];

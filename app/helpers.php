<?php
use Illuminate\Http\Request;

function formatStrToDate($str, $format = 'Y-m-d') {
    /**
     * for admin - format = Y-m-d
     * for client - format = d M Y
     */

    if (is_null($str)) {
        return '';
    } else {
        return date($format, strtotime($str));
    }
}

function getFileUploadSection ($mime) {
    /**
     *  get directory name for uploading file according to its mime-type
     */

    $parts = explode('/', $mime);

    if ($parts[0] === 'image') {
        return 'images';
    } elseif ($parts[1] === 'pdf') {
        return 'docs';
    } else {
        return 'files';
    }
}

function getFromModelOrSession ($instance, $propName) {

    if (old($propName)) {
        return old($propName);
    } else if (!empty($instance)) {
        return $instance->$propName;
    } else {
        return '';
    }
}

function getImageLink ($type, $path, $ext = 'jpg') {
    return config('app.url') . '/image/' . $type . '/' . $path . '.' . $ext;
}

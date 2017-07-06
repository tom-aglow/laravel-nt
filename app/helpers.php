<?php

function formatStrToDate($str, $format = 'Y-m-d') {
    /**
     * for admin - format = Y-m-d
     * for client - format = d M Y
     */
    return date($format, strtotime($str));
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

    if (!empty($instance)) {
        return $instance->$propName;
    } else if (isset(session('prev_request')[$propName])) {
        return session('prev_request')[$propName];
    } else {
        return '';
    }
}

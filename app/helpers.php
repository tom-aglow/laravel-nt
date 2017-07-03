<?php

function formatStrToDate($str, $format = 'Y-m-d') {
    /**
     * for admin - format = Y-m-d
     * for client - format = d M Y
     */
    return date($format, strtotime($str));
}

function getFileUploadSection ($mime) {
    $parts = explode('/', $mime);

    if ($parts[0] === 'image') {
        return 'images';
    } elseif ($parts[1] === 'pdf') {
        return 'docs';
    } else {
        return 'files';
    }
}

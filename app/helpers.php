<?php

function formatStrToDate($str, $format = 'Y-m-d') {
    /**
     * for admin format = Y-m-d
     * for client format = d M Y
     */
    return date($format, strtotime($str));
}

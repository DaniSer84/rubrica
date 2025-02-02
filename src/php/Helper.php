<?php

namespace Rubrica\Php;

class Helper {

    static function formatFileSize (int $bytes, int $decimals = 2): string {

        $size = ['B','kB','MB','GB','TB','PB','EB','ZB','YB'];
        $factor = floor((strlen($bytes) -1) / 3);
        
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
        
    }

}
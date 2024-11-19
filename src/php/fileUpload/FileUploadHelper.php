<?php

namespace Rubrica\Php\FileUpload;

class FileUploadHelper {

    const UPLOAD_DIR = "C:/WebDev/CODE/rubrica/src/pictures";
    
    static function formatFileSize (int $bytes, int $decimals = 2): string {

        $size = ['B','kB','MB','GB','TB','PB','EB','ZB','YB'];
        $factor = floor((strlen($bytes) -1) / 3);
        
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
        
    }
    
}
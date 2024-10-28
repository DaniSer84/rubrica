<?php   

namespace Rubrica\Php;
class ImageUpload {

    static function formatFileSize (int $bytes, int $decimals = 2): string {

        $size = ['B','kB','MB','GB','TB','PB','EB','ZB','YB'];
        $factor = floor((strlen($bytes) -1) / 3);
        
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
        
    }

    static function getMimeType($img) {

             $info = finfo_open(FILEINFO_MIME_TYPE);

        if (!$info) {

            return false;
            
        }

        $mime_type = finfo_file($info, $img);
        finfo_close($info);

        return $mime_type;
        
    }
    
}
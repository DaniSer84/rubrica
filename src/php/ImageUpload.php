<?php   

namespace Rubrica\Php;

use Rubrica\Php\Components\Image;
class ImageUpload {

    const ALLOWED_FILES = [
        'image/png' => 'png',
        'image/jpeg' => 'jpg'
    ];
    const MAX_SIZE = 2 * 1024 * 1024;

    const MESSAGES = [
        UPLOAD_ERR_OK => 'File uploaded successfully',
        UPLOAD_ERR_INI_SIZE => 'File is too big to upload',
        UPLOAD_ERR_FORM_SIZE => 'File is too big to upload',
        UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder on the server',
        UPLOAD_ERR_CANT_WRITE => 'File is failed to save to disk.',
        UPLOAD_ERR_EXTENSION => 'File is not allowed to upload to this server',
    ];

    public array $data;

    public string $tmp;
    private Image $image;

    private function __construct($data) {

        $this->data = $data;
        
    }

    static function validateImage() {


        
    }

    private function getStatus() {

        $status = $this->data['error'];
        $message = self::MESSAGES[$status];
        
        if ($status) {

            return "Error uploading file: $message";
            
        }
    }

    private function checkSize() {

        //
        
    }

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

    // static function formatFileName() {

    //     return str_replace(' ', '-', $name);

    // }

    
}
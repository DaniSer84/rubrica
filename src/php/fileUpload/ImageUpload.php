<?php   

namespace Rubrica\Php\FileUpload;

use Rubrica\Php\Helper;

class ImageUpload {

    const UPLOAD_DIR = "C:/WebDev/CODE/rubrica/src/pictures";
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
    public string $name;
    public string $tmp;
    public ?string $mimeType;
    
    public function __construct($data) {

        $this->data = $data;
        $this->name = str_replace(' ', '-', $data["name"]);
        $this->tmp = $data['tmp_name'];
        $this->mimeType = $this->getMimeType();

    }

    public function validateImage($backLink) {
        
        if ( $this->statusCheck() !== "OK") {
            echo  $this->statusCheck() . $backLink;
                die();
            } else if ($this->sizeCheck() !== "OK"){
                echo  $this->sizeCheck() . $backLink;
                    die();
            } else if ($this->typeCheck() !== "OK") {
                echo  $this->typeCheck() . $backLink;
                    die();
            } else if ($this->moveFile() !== "OK") {
                echo  $this->moveFile() . $backLink;
                    die();
            } 
        
    }

    public function statusCheck() {

        $status = $this->data['error'];
        $message = self::MESSAGES[$status];
        
        if ($status) {

            return "Error uploading file: $message <br>";
            
        }

        return "OK";

    }

    public function sizeCheck() {

        $filesize = $this->getSize();

        if ($filesize > self::MAX_SIZE) {
            
            return "File size exceeds limit: <br> File size: " . 
            Helper::formatFileSize($filesize) . 
            "<br> allowed " . 
            Helper::formatFileSize(self::MAX_SIZE) .
            "<br>";
            
        }

        return "OK";
    }

    public function typeCheck() {

        // $mimetype =  $this->getMimeType();
        
        if (!in_array($this->mimeType, array_keys(self::ALLOWED_FILES))) {

            return "file type not allowed<br>";
            
        }

        return "OK";
        
    }

    public function getUploadedFile() {

        return pathinfo($this->name, PATHINFO_FILENAME) . '.' . self::ALLOWED_FILES[$this->mimeType];

    }

    public function getFilepath() {

        return self::UPLOAD_DIR . '/' . $this->getUploadedFile();
        
    }

    public function moveFile() {

        
        $filepath = $this->getFilepath();

        if (!file_exists($filepath)) {
            $success = move_uploaded_file($this->tmp, $filepath);
            if (!$success) {
                    return "Error moving the file to the upload folder<br>";
                }
        }

        return "OK";
        
    }

    public function getBase64() {

        $fileData = file_get_contents($this->getFilepath());
        $type = self::ALLOWED_FILES[$this->mimeType];
        
        return "data:image/" . $type . ";base64," . base64_encode($fileData);
    }

    
    public function getMimeType() {

        if ($this->tmp) {

            $info = finfo_open(FILEINFO_MIME_TYPE);

            if (!$info) {
    
                return false;
    
            }
    
            $mime_type = finfo_file($info, $this->tmp);
            finfo_close($info);
    
            return $mime_type;
                
            
        }
        
    }

    public function getSize() {

        return filesize($this->tmp);
        
    }

}
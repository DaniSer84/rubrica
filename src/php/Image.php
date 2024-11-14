<?php

namespace Rubrica\Php;

class Image
{
    public string $name;
    public string $tmp;

    // public int $id;
    // public string $mime_type;
    // public string $type;
    // public string $base64;
    // public string $uploadedFile;
    // public int $size;
    // public string $filepath;

    public function __construct($data)
    {
        $this->name = str_replace(' ', '-', $data["name"]);
        ;
        $this->tmp = $data['tmp_name'];
    }

    public function getMimeType()
    {

        $info = finfo_open(FILEINFO_MIME_TYPE);

        if (!$info) {

            return false;

        }

        $mime_type = finfo_file($info, $this->tmp);
        finfo_close($info);

        return $mime_type;

    }

    public function getSize() {

        return filesize($this->tmp);
        
    }



}
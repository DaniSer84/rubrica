<?php

namespace Rubrica\Php\FormRequest;

class FormRequest {

    const GET = "GET";
    const POST = "POST";
    public array $data;
    public string $referer;
    public array $fileData;
    public string $request;

    public function __construct($data, $server, $fileData = null) {

        $this->data = $data;
        $this->referer = $server["HTTP_REFERER"];
        $this->fileData = $fileData;
        $this->request = $server['REQUEST_METHOD'];
        
    }

    public function sendRequest() {
        
        if ($this->request === self::GET) {
           return $this->get();
        }

        if ($this->request === self::POST) {
            return $this->post();
        }

    }
    
    public function get() {

    }

    public function post() {

    }
    
}
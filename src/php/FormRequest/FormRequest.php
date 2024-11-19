<?php

namespace Rubrica\Php\FormRequest;

use Daniser\Rubrica\DatabaseContract;

class FormRequest {

    const METHOD = [
        "get" => "GET",
        "post" => "POST"
    ];

    public array $request;
    public array $files;
    public string $referer;
    public array $fileData;
    public string $method;
    public DatabaseContract $db;


    public function __construct($request, $files, $server, DatabaseContract $db) {

        $this->request = $request;
        $this->files = $files;
        $this->referer = $server["HTTP_REFERER"];
        $this->method = $server['REQUEST_METHOD'];
        $this->db = $db;
        
    }

    public function sendRequest() {
        
        if ($this->method === self::METHOD["get"]) {
           return $this->get();
        }

        if ($this->method === self::METHOD["post"]) {
            return $this->post();
        }

    }
    
    public function get() {

        
        $id = $this->request["item_id"];
        
        $contact = $this->db->getData("SELECT * FROM contacts WHERE id = ?", [$id])->fetch();
        
        if (!$contact) {
            
            die("Actor not found.");
            
        }
        
        $picture = $this->db->getData("SELECT content FROM pictures WHERE contact_id = " . $contact['id'])->fetch();
        
        $data = [
            "contact" => $contact,
            "picture" => $picture
        ];

        return $data;
    }

    public function post() {

    }
    
}
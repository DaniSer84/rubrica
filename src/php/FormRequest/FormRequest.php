<?php

namespace Rubrica\Php\FormRequest;

use Daniser\Rubrica\DatabaseContract;
use Rubrica\Php\FileUpload\FileUploadHelper;
use Rubrica\Php\FileUpload\ImageUpload;

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

            
        $id = $this->request["id"];
        $name = $this->request["name"];
        $surname = $this->request["surname"];
        $phoneNumber = $this->request["phone_number"];
        $company = $this->request["company"];
        $role = $this->request["role"];
        $email = $this->request["email"];
        $birthdate = $this->request["birthdate"];
        $active = $this->request["active"];
        $backTo = $this->request["back-to"];
        $backLink = "<a href=$backTo>Back</a>";


    if ($this->files["picture"]["name"]) {
        
        $imageUpload = new ImageUpload($this->files['picture'], FileUploadHelper::UPLOAD_DIR);
        $imageUpload->validateImage($backLink);
        $mime_type = $imageUpload->mimeType;
        $base64 = $imageUpload->getBase64();

        $updatePicture = "UPDATE pictures SET 
                        content = '$base64',
                        type = '$mime_type' 
                        WHERE contact_id = '$id'";
        
        $this->db->doWithTransaction([
            $updatePicture
        ]);
    }

    if ($_POST["clear-picture"]) {

        $base64 = null;
        $mime_type = null;
        
        $updatePicture = "UPDATE pictures SET 
                        content = '$base64',
                        type = '$mime_type' 
                        WHERE contact_id = '$id'";
        
        $this->db->doWithTransaction([
            $updatePicture
        ]);
        
    }

    $updateContact = "UPDATE contacts SET
                        name = '$name',  
                        surname = '$surname', 
                        phone_number = '$phoneNumber', 
                        company = '$company', 
                        role = '$role',
                        email = '$email', 
                        birthdate = '$birthdate', 
                        active = '$active' 
                        WHERE id = '$id'";


    $this->db->doWithTransaction([
        $updateContact
    ]);

    header("Location: $backTo");
    exit;
        

    }
    
}
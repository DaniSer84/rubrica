<?php

namespace Rubrica\Php\FormRequest;

use Daniser\Rubrica\DatabaseContract;
use Daniser\Rubrica\Helper;
use Rubrica\Php\FileUpload\ImageUpload;
use Rubrica\Php\QueryBuilder\QueryBuilder;

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
        
        if ($this->method === self::METHOD["get"] && count($this->request)) {
           return $this->get();
        }

        if ($this->method === self::METHOD["post"]) {
            return $this->post();
        }

    }
    
    public function get() {

        
        $id = $this->request["item_id"];
        
        $contact = $this->db->getData(QueryBuilder::GetOne(), [$id])->fetch();
        $picture = $this->db->getData(QueryBuilder::GetPicture(), [$id])->fetch();
        
        if (!$contact) {

            if ($_SERVER['URL'] === '/src/pages/contact.php') {
                $data = [
                    "contact" => '',
                    "picture" => ''
                ];
                return $data;
            }
            
            die("Actor not found.");
            
        }
        
        
        $data = [
            "contact" => $contact,
            "picture" => $picture
        ];

        return $data;
    }

    public function post() {

        $backTo = $this->request['back-to'];
        $backLink = "<a href=$backTo>Back</a>";
        
        $fileData = $this->getFileData($backLink);

        if ($_SERVER['URL'] === '/src/pages/insert.php') {

           $this->insert($fileData);
            
        }

        if ($_SERVER['URL'] === '/src/pages/update.php') {

            $this->update($fileData);
            
        }
        
        
        header("Location: $backTo");
        exit;
        
    }

    private function getFileData($backLink) {

        $data = [
            null,
            null
        ];
        
        if ($this->files["picture"]["name"]) {

            $imageUpload = new ImageUpload($this->files['picture']);
            $imageUpload->validateImage($backLink);
            $mime_type = $imageUpload->mimeType;
            $base64 = $imageUpload->getBase64();

            $data[0] = $base64;
            $data[1] = $mime_type;
        }

        return $data;        
        
    }

    private function insert($fileData) {

        $insertContact = QueryBuilder::InsertContact($this->request);
            
        $insertPicture = QueryBuilder::InsertPicture($fileData);
    
        $this->db->doWithTransaction([
            $insertContact,
            $insertPicture,
        ]);
        
    }

    private function update($fileData) {

        $fields = Helper::setUpdateFields($this->request);
            $items = Helper::setItems($fields);
            $id = $this->request["id"];
            $pictureItems = null;

            if ($fileData[0] && $fileData[1]) {
                
                $pictureItems = [
                    $fileData[0],
                    $fileData[1],
                    $id
                ];
                
            }

            if ($this->request["clear-picture"]) {

                $pictureItems = [
                    '',
                    '',
                    $id
                ];

            }

            if($pictureItems) {
                $this->db->setData(QueryBuilder::UpdatePicture(), [$pictureItems]);
            }

            array_push($items, $id);

            $this->db->setData(QueryBuilder::UpdateContact(), [$items]);

    }
    
}
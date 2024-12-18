<?php

namespace Rubrica\Php\FormRequest;

use Daniser\Rubrica\Helper;
use Rubrica\Php\FileUpload\ImageUpload;
use Rubrica\Php\QueryBuilder\QueryBuilder;

class FormRequest {

    private QueryBuilder $queryBuilder;

    public function __construct() {

        $this->queryBuilder = new QueryBuilder();
        
    }

    public function sendRequest() {

        if ($_SERVER['REQUEST_METHOD'] === "GET" && count($_REQUEST)) {

            if ($_SERVER['URL'] === '/src/pages/delete.php')
                return $this->delete();
            
            return $this->get();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            return $this->post();
        }

    }
    
    public function get() {

        
        $id = $_REQUEST["item_id"];
        
        $contact = $this->queryBuilder->getOne($id)->fetch();
        $picture = $this->queryBuilder->getPicture($id)->fetch();
        
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

        $backTo = $_REQUEST['back-to'];
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

    public function delete() {

        $id = $_REQUEST["item_id"];
        
        $this->queryBuilder->deleteContact([$id]);

        header("Location: " . $_SERVER['HTTP_REFERER']);
        
    }

    private function getFileData($backLink) {

        $data = [
            null,
            null
        ];
        
        if ($_FILES["picture"]["name"]) {

            $imageUpload = new ImageUpload($_FILES['picture']);
            $imageUpload->validateImage($backLink);
            $mime_type = $imageUpload->mimeType;
            $base64 = $imageUpload->getBase64();

            $data[0] = $base64;
            $data[1] = $mime_type;
        }

        return $data;        
        
    }

    private function insert($fileData) {

        $this->queryBuilder->insertContact($_REQUEST, $fileData);
        
    }

    private function update($fileData) {

        $fields = Helper::setUpdateFields($_REQUEST);
        $items = Helper::setItems($fields);
        $id = $_REQUEST["id"];
        $pictureItems = null;

        if ($fileData[0] && $fileData[1]) {
             
            $pictureItems = [
                $fileData[0],
                $fileData[1],
                $id
            ];
            
        }

        if ($_REQUEST["clear-picture"]) {

            $pictureItems = [
                '',
                '',
                $id
            ];

        }

        if ($pictureItems) {
            $this->queryBuilder->updatePicture([$pictureItems]);
        }

        array_push($items, $id);

        $this->queryBuilder->updateContact([$items]);

    }
    
}
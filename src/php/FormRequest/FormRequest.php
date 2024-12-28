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

        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            if ($_SERVER['URL'] === '/src/pages/delete.php')
                return $this->delete();

            if (array_key_exists('item_id', $_GET) && $_SERVER['URL'] !== '/src/pages/common.php')
                return $this->getOne();
            
            return $this->getData();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            return $this->post();
        }

    }

    private function getData() {

        $queryBuilder = new QueryBuilder();
        $data = $queryBuilder->getData();

        return $data;
        
    }
    
    public function getOne() {
        
        $id = $_GET["item_id"];
        
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

        $backTo = $_POST['back-to'];
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

        $id = $_GET["item_id"];
        
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

        $this->queryBuilder->insertContact($_POST, $fileData);
        
    }

    private function update($fileData) {
        
        $fields = Helper::setRelevantFields($_POST, 'update');
        $items = Helper::setItems($fields);

        // TODO: fix type and null problems 
        
        $items[7] = $items[7] === '' ? null : $items[7];

        $id = $_POST["id"];
        $pictureItems = null;

        if ($fileData[0] && $fileData[1]) {
             
            $pictureItems = [
                $fileData[0],
                $fileData[1],
                $id
            ];
            
        }

        if (isset($_POST["clear-picture"])) {

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
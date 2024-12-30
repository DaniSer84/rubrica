<?php 

namespace Rubrica\Php\FormRequest;

use Rubrica\Php\FileUpload\ImageUpload;
use Rubrica\Php\Helper;
use Rubrica\Php\QueryBuilder\QueryBuilder;

class FormRequest {

    private QueryBuilder $queryBuilder;

    private FormValidation $formValidation;

    public function __construct() {

        $this->queryBuilder = new QueryBuilder();
        $this->formValidation = new FormValidation();
        
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

        $data = $this->queryBuilder->getData();

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
        
        header('Location: insertSuccess.php');
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

        $sanitazedData = $this->formValidation->sanitizeInput($_POST);

        $checkedData = $this->formValidation->validateData($sanitazedData);

        if (count($checkedData[1])) {

            $_SESSION['file_data'] = $fileData;
            $_SESSION['contact_data'] = $sanitazedData;
            $_SESSION['errors'] = $checkedData[1];
            $_SESSION['checked_data'] = $checkedData[0];
            
            header('Refresh:0');
            die();
        }
        
        $this->queryBuilder->insertContact($checkedData[0], $fileData);
        
    }

    private function update($fileData) {
        
        $sanitazedData = $this->formValidation->sanitizeInput($_POST, 'update');

        $checkedData = $this->formValidation->validateData($sanitazedData);

        
        if (count($checkedData[1])) {
            
            $_SESSION['contact_data'] = $sanitazedData;
            $_SESSION['file_data'] = $fileData;
            $_SESSION['errors'] = $checkedData[1];
            $_SESSION['checked_data'] = $checkedData[0];
            
            header('Refresh:0');
            die();
            
        }

        $id = $_POST["id"];
        $_SESSION['id'] = $id;
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
                null,
                null,
                $id
            ];

        }

        if ($pictureItems) {
            $this->queryBuilder->updatePicture([$pictureItems]);
        }

        array_unshift($checkedData[0], $sanitazedData['active']);
        $items = Helper::setItems($checkedData[0]);
        array_push($items, $id);

        $items = array_map(fn($v) => $v !== '' ? $v : null , $items);

        $this->queryBuilder->updateContact([$items]);

    }
    
}
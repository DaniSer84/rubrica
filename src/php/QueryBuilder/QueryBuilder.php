<?php

namespace Rubrica\Php\QueryBuilder;
use Daniser\Rubrica\DatabaseContract;
use Daniser\Rubrica\DatabaseFactory;
use Daniser\Rubrica\Helper;

class QueryBuilder {

    private DatabaseContract $db;
    
    public function __construct() {
        $this->db = DatabaseFactory::Create();
    }

    const FIELDS = [

        "id",
        "name",
        "surname",
        "phone_number",
        "company",
        "role",
        "email",
        "birthdate",
        "created_at",
        "active",

    ];

    public function getOne($id) {

        $query = "SELECT * FROM contacts WHERE id = ?";

        return $this->db->getData($query, [$id]);

    }

    public function getAll() {
        
        $query = "SELECT * FROM contacts";

        return $this->db->getData($query, []);

    }

    public function getPicture($id) {

        $query = "SELECT content FROM pictures WHERE contact_id = ?";

        return $this->db->getData($query, [$id]);

    }

    public function insertContact($contactData, $fileData) {

        $relevantKeys = Helper::setRelevantFields($contactData);
        $fields = Helper::setFields($relevantKeys);
        $values = Helper::setQueryValues($relevantKeys);
    
        $contactQuery = "INSERT INTO contacts ( $fields ) VALUES ( $values )";
        $pictureQuery = "INSERT INTO pictures ( content, type, contact_id ) 
                         VALUES ( '$fileData[0]', '$fileData[1]', last_insert_id() )";

        return $this->db->doWithTransaction([
            $contactQuery,
            $pictureQuery
        ]);
        
    }

    public function deleteContact($params) {

        $query = "DELETE FROM contacts WHERE id = ?";

        return $this->db->deleteData($query, $params);

    }

    public function updateContact($params) {

        $query = "UPDATE contacts SET
                 active = ?, 
                 name = ?,  
                 surname = ?, 
                 phone_number = ?, 
                 email = ?, 
                 company = ?, 
                 role = ?,
                 birthdate = ?
                 WHERE id = ?";

        return $this->db->setData($query, $params);

    }

    public function updatePicture($params) {

        $query = "UPDATE pictures SET 
                 content = ?,
                 type = ? 
                 WHERE contact_id = ?";

        return $this->db->setData($query, $params);

    }

    public function searchContact($params) {

        $query = "SELECT * FROM contacts WHERE ";

        foreach(self::FIELDS as $field) {

            $query .= "$field LIKE :kw1 OR $field LIKE :kw2 OR $field LIKE :kw3 OR ";

        }

        $query = rtrim($query, ' OR');

        return $this->db->getData($query, $params);
        
    }

    public function getData() {

        $search = $_GET['search'] ?? "";

        // TODO: handle multiple words es: 'Daniele Serenelli'

        // print_r($search);
        // die();

        $data = $search !== "" ? 
                $this->searchContact([
                    "kw1" => "$search%",
                    "kw2" => "%$search%",
                    "kw3" => "%$search",
                ]) :
                $this->getAll();

        return $data;
        
    }

    public function applyOrderOption($data) {

        if (isset($_GET['order'])) {

            $i = $_GET['order'];
            $reverse = isset($_GET['decr']) ?: false;

            usort($data, function ($a, $b) use ($i, $reverse) {

                $a = $a[$i] ?: "";
                $b = $b[$i] ?: "";

                return $reverse ? strnatcmp($b, $a) : strnatcmp($a, $b);

            });

        }

        return $data;
        
    }

    
}
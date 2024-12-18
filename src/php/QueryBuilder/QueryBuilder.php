<?php

namespace Rubrica\Php\QueryBuilder;
use Daniser\Rubrica\Helper;

class QueryBuilder {

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

    static function GetOne() {

        return "SELECT * FROM contacts WHERE id = ?";

    }

    static function GetAll() {
        
        return "SELECT * FROM contacts";

    }

    static function GetPicture() {

        return "SELECT content FROM pictures WHERE contact_id = ?";

    }

    static function InsertContact($data) {

        $relevantKeys = Helper::setRelevantFields($data);
        $fields = Helper::setFields($relevantKeys);
        $values = Helper::setQueryValues($relevantKeys);
    
        return "INSERT INTO contacts ( $fields ) VALUES ( $values )";
        
    }

    static function InsertPicture(array $fileData): string {

        return "INSERT INTO pictures ( content, type, contact_id ) VALUES ( '" . $fileData[0] . "', '" . $fileData[1] . "', last_insert_id() )";

    }

    static function DeleteContact() {

        return "DELETE FROM contacts WHERE id = ?";

    }

    static function UpdateContact() {

        return "UPDATE contacts SET
                active = ?, 
                name = ?,  
                surname = ?, 
                phone_number = ?, 
                email = ?, 
                company = ?, 
                role = ?,
                birthdate = ?
                WHERE id = ?";

    }

    static function UpdatePicture() {

        return "UPDATE pictures SET 
                content = ?,
                type = ? 
                WHERE contact_id = ?";

    }

    static function search() {

        $query = "SELECT * FROM contacts WHERE ";

        foreach(self::FIELDS as $field) {

            $query .= "$field LIKE :kw1 OR $field LIKE :kw2 OR $field LIKE :kw3 OR ";

        }

        return rtrim($query, ' OR');
        
    }

    
}
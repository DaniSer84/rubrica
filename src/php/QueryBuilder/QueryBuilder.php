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
        "picture"

    ];

    static function GetOne() {

    }

    static function GetAll() {

    }

    static function GetPicture() {

    }

    static function InsertContact($data) {

        $relevantKeys = array_filter($data, function ($key) {
            return in_array($key, self::FIELDS);
        }, ARRAY_FILTER_USE_KEY);
    
        $fields = Helper::setFields($relevantKeys);
        $values = Helper::setQueryValues($relevantKeys);
    
        $insertContact = "INSERT INTO contacts ( $fields ) VALUES ( $values )";

        return $insertContact;
        
    }

    static function InsertPicture($base64, $mimeType) {

        return "INSERT INTO pictures ( content, type, contact_id ) VALUES ( '$base64', '$mimeType', last_insert_id() )";

    }

    static function DeleteContact() {

    }

    static function UpdateContact() {

    }

    static function UpdatePicture() {

    }

    
}
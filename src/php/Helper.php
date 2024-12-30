<?php

namespace Rubrica\Php;

use Rubrica\Php\FormRequest\FormValidation;

class Helper {


    public const FIELDS = [

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

    public static function filterFields($fields, $filter) {
        return array_filter($fields, fn($f) => !in_array($f, $filter));
    }

    public static function createContactTable( array $item, string $hasImage): string
    {   

        $id = Self::AccessToValue($item,"id");
        $name = Self::AccessToValue($item,"name");
        $surname = Self::AccessToValue($item,"surname");
        $phone_number = Self::AccessToValue($item,"phone_number");
        $company = Self::AccessToValue($item,"company");
        $role = Self::AccessToValue($item,"role");
        $email = Self::AccessToValue($item,"email");
        $birthdate = Self::AccessToValue($item,"birthdate");
        $createdAt = Self::AccessToValue($item,"created_at");
        $active = Self::AccessToValue($item,"active");
        
        
        return  
                "<tr>
                    <th scope='row'>
                        <a href='contact.php?item_id=$id'>$id</a>
                    </th>
                    <td>$name</td>
                    <td>$surname</td>
                    <td>$phone_number</td>
                    <td>$company</td>
                    <td>$role</td>
                    <td>$email</td>
                    <td>$birthdate</td>
                    <td>$createdAt</td>
                    <td>
                    <div class='form-check form-switch'> 
                        <input class='form-check-input' type='checkbox' role='switch' value='$active' disabled>
                    </div></td>
                    <td>$hasImage</td>
                    <td>
                        <div class='list-item-btn-container flex-row justify-content-end'>
                            <a href='update.php?item_id=$id'>
                                <button class='btn btn-info'><i class='fa-solid fa-pen-to-square'></i></button>
                            </a>
                            <button type='button' class='btn btn-danger set-to-delete' data-bs-toggle='modal' data-bs-target='#deleteItem' data-id='$id'><i class='fa-solid fa-trash-can'></i></button>
                        </div>
                    </td>
                </tr>";

    }

    public static function AccessToValue( ?array $values, string $key, $default = null ) {

        if ( is_null($values) )
            return $default;
        
        return array_key_exists( $key, $values ) ? $values[ $key ] : $default;
        
    }

    public static function createCardItem($key, $value) {
        $icons = [
          "id" => "fa-list-ol",
          "name" => "fa-user", 
          "surname" => "",
          "phone_number" => "fa-phone",
          "email"=> "fa-envelope",
          "company"=> "fa-building",
          "role"=> "fa-briefcase",
          "birthdate"=> "fa-cake-candles",
          'created_at' => "fa-calendar",
          "active" => "fa-circle-check",
        ];
        
        $ucKey = "<em class='field-label'>" . ucfirst($key) . "</em>";

        $item = "";

        if ( !is_numeric($key) ) {

            $item .= "<div class='field'><i class='fa-solid $icons[$key]'></i><span class='field-label'>" . ($value ? $value : $ucKey) . "</span></div>";
            
        }
      
        
        return $item;
      }
      
      public static function setTokens ( array $array): string {

        $numOfTokens = 0;
        $tokens = "";

        foreach ( $array as $value ) {

            if ( $value ) {

                $numOfTokens++;
                
            }

        }

        $i = 0;
        while ( $i < $numOfTokens ) {

            $tokens .= "?,";
            $i++;
            
        }
        
        return rtrim($tokens, ",");
    }

    public static function setFields($array) {

        $fields = "";
        
        foreach( $array as $key => $value ) {


            if ( $value ) {
    
                $fields .= "$key,";
    
            }
            
        }

        return rtrim($fields, ",");
        
    }

    public static function setQueryValues( $array) {

        $values = [];

        foreach ( $array as $value ) {
    
            if ( $value ) {
    
                array_push($values, $value);
                
            }
            
        }
    
        return $values;

    }
    
    static function setItems($data) {

        $items = [];

        foreach($data as $item) {

            array_push($items, $item);
            
        }

        return $items;
        
    }

    public static function setMarks($array) {

        $marks = '';
        $i = 0;
        while ($i < count($array)) {
            $marks .= '?,';
            $i++;
        }

        return rtrim($marks, ',');
        
    }

    // TODO: check for visibility modifier https://www.php.net/manual/language.oop5.basic.php
    
    static function setRelevantFields($data, $filter = null) {

        return array_filter($data, function ($key) use ($filter) {
            return in_array($key, !$filter ? self::FIELDS : self::filterFields(self::FIELDS, $filter));
        }, ARRAY_FILTER_USE_KEY);

    }

    static function formatFileSize (int $bytes, int $decimals = 2): string {

        $size = ['B','kB','MB','GB','TB','PB','EB','ZB','YB'];
        $factor = floor((strlen($bytes) -1) / 3);
        
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
        
    }

    public static function setValue($field) {

        if ($field === 'file_data') {

            return  isset($_SESSION['file_data']) && $_SESSION['file_data'][0] !== null ? $_SESSION['file_data'][0] : "../img/user-account.png";
            
        }

        return  $_SESSION['contact_data'][$field] ?? '';
        
    }

    public static function setError($field) {

        return isset($_SESSION['errors'][$field]) ? FormValidation::ERRORS[$_SESSION['errors'][$field]] : '';
        
    }

}
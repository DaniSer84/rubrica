<?php

namespace Daniser\Rubrica;
class Helper {

    public static function createNameSurnameListItem( array $item) {

        return "<li class='list-group-item d-flex justify-content-between align-items-center'><span class='list-item-text'>" .
            $item['id'] . ": " . $item['name'] .
            " " . $item['surname'] . "</span>" .
            "<div class='list-item-btn-container'>" .
            "<a href='update.php?item_id=" . $item['id'] . "'>" .
            "<button class='btn btn-info'><i class='fa-solid fa-pen-to-square'></i></button>" .
            "</a>" .
            "<a href='delete.php?item_id=" . $item['id'] . "'>" .
            "<button class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></button>" .
            "</a>" .
            "</div></li>";
        
    }

    public static function createContactTable( array $item): string
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
        
        
        return  "<tr>" . 
                    "<th scope='row'>$id</th>" . 
                    "<td>$name</td>" . 
                    "<td>$surname</td>" . 
                    "<td>$phone_number</td>" . 
                    "<td>$company</td>" . 
                    "<td>$role</td>" . 
                    "<td>$email</td>" . 
                    "<td>$birthdate</td>" . 
                    "<td>$createdAt</td>" . 
                    "<td>" . 
                    "<div class='form-check form-switch'> 
                        <input class='form-check-input' type='checkbox' role='switch' value='$active' disabled>
                    </div></td>" . 
                    "<td>" .    
                        "<div class='list-item-btn-container flex-row justify-content-end'>" .
                            "<a href='src/pages/update.php?item_id=$id'>" .
                                "<button class='btn btn-info'><i class='fa-solid fa-pen-to-square'></i></button>" .
                            "</a>" .
                            "<button type='button' class='btn btn-danger set-to-delete' data-bs-toggle='modal' data-bs-target='#deleteItem' data-id='$id'><i class='fa-solid fa-trash-can'></i></button>" .
                    "</div>" . 
                    "</td>" . 
                "</tr>";
    
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

        $values = "";

        foreach ( $array as $value ) {
    
            if ( $value ) {
    
                $values .= "'$value',";
                
            }
            
        }
    
        return rtrim($values, ",");

    }
    
}
<?php

namespace Daniser\Rubrica;
class Helper {

    public static function createContactListItem( array $item): string
    {
    
        return "<li class='list-group-item d-flex justify-content-between align-items-center'><span class='list-item-text'>" .
            $item['id'] . ": " . $item['name'] .
            " " . $item['surname'] . "</span>" .
            "<div class='list-item-btn-container'>" .
            "<a href='update.php?item_id=" . $item['id'] . "'>" .
            "<button class='btn btn-info'><i class='fa-solid fa-pen-to-square'></i></button>" .
            "</a>" .
            "<a href='delete.php?item_id=" . $item['id'] . "'>" .
            "<button class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></button>" .
            "<a/>" .
            "</div></li>";
    
    }

    public static function AccessToValue( ?array $values, string $key, $default = null ) {

        if ( is_null($values) )
            return $default;
        
        return array_key_exists( $key, $values ) ? $values[ $key ] : $default;
        
    }

    public static function createItem($key, $value) {
        $icons = [
          "name" => "fa-user-pen", 
          "surname" => "fa-user-pen",
          "telephone" => "fa-phone",
          "email"=> "fa-envelope",
          "society"=> "fa-building",
          "position"=> "fa-briefcase",
          "birthday"=> "fa-calendar",
        ];
        
        $ucKey = "<em class='field-label'>" . ucfirst($key) . "</em>";
      
        $item = "<div class='field'><i class='fa-solid $icons[$key]'></i><span class='field-label'>" . ($value ? $value : $ucKey) . "</span></div>";
        
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

    public static function setString($array) {

        $string = "";
        
        foreach( $array as $key => $value ) {


            if ( $value ) {
    
                $string .= "$key,";
    
            }
            
        }

        return rtrim($string, ",");
        
    }

    public static function setQueryValues( $array) {

        $values = [];

        foreach ( $array as $value ) {
    
            if ( $value ) {
    
                array_push($values, $value) ;
                
            }
            
        }
    
        return $values;

    }
    
}
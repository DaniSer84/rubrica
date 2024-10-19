<?php

namespace Test\DatabaseAbstraction;
class Helper {

    public static function listItem( array $actor): string
    {
    
        return "<li class='list-group-item d-flex justify-content-between'><span class='list-item-text'>" .
            $actor['actor_id'] . ": " . $actor['first_name'] .
            " " . $actor['last_name'] . "</span>" .
            "<div class='list-item-btn-container'>" .
            "<a href='update.php?actor_id=" . $actor['actor_id'] . "'>" .
            "<button class='btn btn-info'><i class='fa-solid fa-pen-to-square'></i></button>" .
            "</a>" .
            "<a href='delete.php?actor_id=" . $actor['actor_id'] . "'>" .
            "<button class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></button>" .
            "<a/>" .
            "</div></li>";
    
    }

    public static function AccessToValue( ?array $values, string $key, $default = null ) {

        if ( is_null($values) )
            return $default;
        
        return array_key_exists( $key, $values ) ? $values[ $key ] : $default;
        
    }
    
}
<?php 
namespace App\Controllers;

class FlashController {
    
    public static function addFlash(string $texte, string $type="success") {

        $_SESSION['messages'][] = array(
            'texte' => $texte,
            'type'=> $type
        );

    }

    public static function getFlash() {
       
        // if( !empty($_SESSION['messages']) ) {
        //     $messages = $_SESSION['messages'];
        // } else {
        //     $messages = array();    
        // }

        // $messages = expression ? si true : si false;
        $messages = !empty($_SESSION['messages']) ? $_SESSION['messages'] : array(); // Structure ternaire

        // depuis php 8 : opérateur Null coalescent 
        // $messages = $_SESSION['messages'] ?? 'valeur'
       
        unset($_SESSION['messages']);
        return $messages;

    }

}
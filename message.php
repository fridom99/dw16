<?php 

class Message {
    public function affiche($texte = '') {
        echo 'message : ' . $texte;
    }

    public function affiche2($texte = '') {
        return 'message : ' . $texte;
    }
}

$msg = new Message();
$msg->affiche('Le texte à afficher');
$msg->affiche();

echo $msg->affiche2('un message');
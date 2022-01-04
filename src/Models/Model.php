<?php 
namespace App\Models;

use PDO;
use PDOException;

/**
 * Model général
 * Permet de regrouper des méthodes communes aux autres models (models spécialisés)
 */
abstract class Model {

    /** Connexion à la base de données */
    private static $instance = null;

    /** 
     * Singleton permettant d'obtenir un accès à la base de données
     * Crée un accès si aucun accès n'est déjà en cours
     * Retourne l'accès en cours si il existe
     */
    public function getInstance() {
        if( self::$instance === null) {
            try {
                self::$instance = new PDO('mysql:host=localhost;dbname=projet', 'root', '');
            } catch( PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$instance;
    }
    
    /** Toutes les lignes d'une table */
    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->getInstance()->query($sql);
    }

    /** Une ligne particulière d'une table */
    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        //...
    }

    /** Lignes correspondant à un critère */
    public function findBy($key, $value) {
        $sql = "SELECT * FROM {$this->table} WHERE $key = $value";
        // ...
    }

}
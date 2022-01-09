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

    /** méthode globale pour exécuter une requête
     * - si la requête possède des paramètres ($attributs) on utilise prepare()
     * - sinon, directement query
     */
    public function request( string $sql, array $attributs=array() ) {
        if( $attributs ) {
            $requete = $this->getInstance()->prepare($sql);
            $requete->execute($attributs);
            return $requete;
        } else {
            return $this->getInstance()->query($sql);
        }
    }
    
    /** Toutes les lignes d'une table */
    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";
        // return $this->getInstance()->query($sql);
        return $this->request($sql);
    }

    /** Une ligne particulière d'une table */
    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        return $this->request($sql, array( 'id' => $id ));
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->request($sql, array( 'id' => $id));
    }

}
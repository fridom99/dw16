<?php 

namespace App\Models;

use PDO;
use App\Models\Model;

/**
 * Modèle spécialisé chargé de réaliser les requêtes SQL relatives aux lessons
 * Hérite du model principal
 */
class LessonsModel extends Model  {

    protected $table = 'lessons';

    /** 
     * Les modèles spécialisés traitent les requêtes fortement couplées
     * au schéma des tables (insert, update)
     */

    public function add(array $data) {
        $sql = "INSERT INTO {$this->table} (libelle, resume, id_categorie) VALUES (:libelle, :resume, :categorie)";
        // $requete = $this->getInstance()->prepare($sql);
        // $requete->execute($data);
        return $this->request($sql, $data );
    }

    public function update(array $data) {
        $sql = "UPDATE {$this->table} SET libelle = :libelle, resume = :resume, id_categorie = :categorie WHERE id = :id";
        return $this->request($sql, $data );
    }

}
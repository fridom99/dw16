<?php 

namespace App\Models;

use PDO;
use App\Models\Model;

class CategoriesModel extends Model {

    protected $table = 'categories';

    public function add(array $data) {
        $sql = "INSERT INTO {$this->table} (libelle) VALUES (:libelle)";
        return $this->request($sql, $data );
    }

    public function update(array $data) {
        $sql = "UPDATE {$this->table} SET libelle = :libelle WHERE id = :id";
        return $this->request($sql, $data );
    }

}
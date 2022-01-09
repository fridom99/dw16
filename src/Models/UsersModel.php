<?php 
namespace App\Models;

class UsersModel extends Model {

    protected $table = "users";

    public function findUser(string $username, string $password) {
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        return $this->request($sql, array(
            'username' => $username,
            'password' => $password,
        ));
    }

    public function updateUser(array $data) {
        $sql = "UPDATE {$this->table} SET nom = :nom, prenom = :prenom, password = :password WHERE id = :id";
        return $this->request($sql, $data);
    }
}
<?php 
namespace App\Models;

class UsersModel extends Model {
    public function findUser(string $username, string $password) {
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        return $this->request($sql, array(
            'username' => $username,
            'password' => $password,
        ));
    }
}
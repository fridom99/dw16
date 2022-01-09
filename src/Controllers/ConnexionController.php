<?php 
namespace App\Controllers;

use App\Models\UsersModel;

class ConnexionController extends Controller {
    
    public function login() {

        if( $_SERVER['REQUEST_METHOD']=='POST') {
            extract($_POST);

            if(empty($username)) { FlashController::addFlash('L\'identifiant est obligatoire', 'danger');}
            if(empty($password)) { FlashController::addFlash('Le mot de passe est obligatoire', 'danger');}

            if(empty($_SESSION['messages'])) {
                $model = new UsersModel();
                $users = $model->findUser($username,$password)->fetchAll();;
                if(empty($users)) {
                    FlashController::addFlash('Identifiant et/ou mot de passe incorrect', 'danger');
                    $this->redirect('login');
                } else {
                    $_SESSION['user'] = array(
                        'id'    =>  $users[0]['id'],
                        'role'  =>  $user[0]['role'],
                    );
                    $this->redirect('users/profil');
                }
            }
        }

        $this->render('users/login', array(
            'username' => '',
        ));

    }
    
    public function logout() {
        unset($_SESSION['user']);
        $this->redirect('login');
    }

    public static function logged_user(string $role='') {
        if( isset($_SESSION['user']['id'])) {
            if( empty($role)) {
                return true;
            } else {
                if($role == $_SESSION['user']['role']) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function register() {}
    public function lostPassword() {}
}
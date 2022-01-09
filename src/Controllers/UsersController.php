<?php 
namespace App\Controllers;

use PDO;
use App\Models\UsersModel;

class UsersController extends Controller {
    
    public function index() {}

    public function profil($id) {

        // if(empty($param[0])) {
        //     $id = $_SESSION['user']['id'];
        // } else {
        //     $id = $param[0];
        // }

        /** Sous la forme ternaire */
        $id = empty($id) ? $_SESSION['user']['id'] : $id;

        $model = new UsersModel();
        $result = $model->find($id);
        $user=$result->fetch(PDO::FETCH_ASSOC);

        if($_SERVER['REQUEST_METHOD']=='POST') {
            
            extract($_POST);

            if(empty($nom)) { FlashController::addFlash("Le nom est obligatoire", 'danger'); }
            if(empty($prenom)) { FlashController::addFlash("Le prénom est obligatoire", 'danger'); }

            if(!empty($password)) {
                
                if(!preg_match('%.{5,16}%', $password)) { FlashController::addFlash("Le mot de passe doit contenir entre 5 et 16 caractères", 'danger');}

                if(!preg_match('%[A-Z]%', $password)) { FlashController::addFlash("Le mot de passe doit contenir au moins une majuscule", 'danger');}
                if(!preg_match('%[a-z]%', $password)) { FlashController::addFlash("Le mot de passe doit contenir au moins une minuscule", 'danger');}
                if(!preg_match('%[0-9]%', $password)) { FlashController::addFlash("Le mot de passe doit contenir au moins un chiffre", 'danger');}
                if(!preg_match('%[!#@$\%_]%', $password)) { FlashController::addFlash("Le mot de passe doit contenir au moins un des caractères suivants : ! # @ $ % _", 'danger');}

                if($password != $password2) { FlashController::addFlash("Les mots de passe ne correspondent pas", 'danger');}

            } else {
                $password = $user['password'];
            }

            if(empty($_SESSION['messages'])) {

                $model->updateUser(array(
                    'id'        =>  $id,
                    'nom'       =>  $nom,
                    'prenom'    =>  $prenom,
                    'password'  =>  $password,
                ));
                $user['nom']       = $nom;
                $user['prenom']    = $prenom;

                FlashController::addFlash("Le profil a été mis à jour", 'success');
            }
        }
        
        $this->render('users/profil', array(
            'user' => $user,
        ));
    }


}
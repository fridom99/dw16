<?php 

namespace App\Controllers;

use App\Models\LessonsModel;
use App\Controllers\Controller;

/**
 * Controller spécialisé chargé de traiter les requêtes relatives aux lessons
 * Hérite du controller principal
 */
class LessonsController extends Controller {

    /** Retourne la liste des lessons */
    public function index() {

        /** Demande le model permettant de traiter les requêtes SQL relatives aux lessons */
        $model      =   new LessonsModel();
        $result     =   $model->findAll();
        $lessons    =   $result->fetchAll();

        /** 
         * Appel de l'affichage de la vue dans le template principal 
         * paramètre 1 : 'lessons/liste' -> chemin + fichier (sans extension) de la vue à utiliser
         * paramètre 2 : tableau contenant les différentes variables à passer à la vue
        */ 

        $this->render('lessons/liste', array(
            'lessons'   =>  $lessons,
            'titre'     =>  "Leçons",
            'description' => 'description SEO friendly',
        ));
        
    }

    /** Ajoute une lesson dans la BDD  */
    public function add() {

        if(!ConnexionController::logged_user()) { $this->redirect('login'); }

        $messages=[];

        if($_SERVER['REQUEST_METHOD']=='POST') {

            extract($_POST);

            /* Vérification des donées saisies */
            if(empty($libelle)) { FlashController::addFlash("Le libellé est obligatoire", 'danger'); }
            // autres vérifications
            
            $libelle = htmlentities(strip_tags($libelle));
            
            /* Fin vérification des donées saisies */

            if(empty($_SESSION['messages'])) {
                $model = new LessonsModel();
                $model->add(array(
                    'libelle' => $libelle,
                ));
                // creer un message
                FlashController::addFlash('La leçon ' . $libelle .' a été ajoutée');
                $this->redirect('lessons');
            }
        
        }
        
        $this->render('lessons/formulaire', array(
            'messages' => $messages,
        ));

    }

    public function show() {
        echo __METHOD__; 
    }

}
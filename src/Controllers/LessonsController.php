<?php 

namespace App\Controllers;

use App\Models\LessonsModel;
use App\Controllers\Controller;
use App\Models\CategoriesModel;

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

    public function show($id) {
        $model = new LessonsModel();
        $lesson = $model->find($id)->fetch();
        $modelCategories = new CategoriesModel();
        $categorie = $modelCategories->find($lesson['id_categorie'])->fetch();;
        $this->render('lessons/fiche', array('lesson' => $lesson, 'categorie'=>$categorie['libelle']));
    }

    /** Ajoute une lesson dans la BDD  */
    public function add() {

        if(!ConnexionController::logged_user()) { $this->redirect('login'); }

        $modelCategories = new CategoriesModel();
        $categories = $modelCategories->findAll()->fetchAll(); 

        if($_SERVER['REQUEST_METHOD']=='POST') {

            extract($_POST);

            /* Vérification des donées saisies */
            if(empty($libelle)) { FlashController::addFlash("Le libellé est obligatoire", 'danger'); }
            if(empty($resume)) { FlashController::addFlash("Le résumé est obligatoire", 'danger'); }
            if(empty($categorie)) { FlashController::addFlash("La catégorie est obligatoire", 'danger'); }


            // autres vérifications
            
            $libelle = htmlentities(strip_tags($libelle));
            
            /* Fin vérification des donées saisies */

            if(empty($_SESSION['messages'])) {
                $model = new LessonsModel();
                $model->add(array(
                    'libelle'       =>  $libelle,
                    'resume'        =>  $resume,
                    'categorie'     =>  $categorie,
                ));
                // creer un message
                FlashController::addFlash('La leçon ' . $libelle .' a été ajoutée');
                $this->redirect('lessons');
            }
        
        }
        
        $this->render('lessons/formulaire', array(
            'lesson'        =>  $_POST,
            'categories'    =>  $categories,
            'id_categorie'     =>  isset($_POST['categorie']) ? $_POST['categorie'] : null,
            'mode'          =>  'ajout',
        ));

    }

    public function modify($id) {
        $model = new LessonsModel();
        $lesson = $model->find($id)->fetch();

        $modelCategories = new CategoriesModel();
        $categories = $modelCategories->findAll()->fetchAll(); 

        if($_SERVER['REQUEST_METHOD']=='POST') {

            extract($_POST);

            if(empty($libelle)) { FlashController::addFlash("Le libelle est obligatoire", 'danger'); }
            if(empty($resume)) { FlashController::addFlash("Le résumé est obligatoire", 'danger'); }
            if(empty($categorie)) { FlashController::addFlash("La catégorie est obligatoire", 'danger'); }

            if(empty($_SESSION['messages'])) {
                // nettoyage
                $model->update(array(
                    'id'        =>  $id,
                    'libelle'   =>  $libelle,
                    'resume'    =>  $resume,
                    'categorie' =>  $categorie,
                ));
                $lesson['libelle'] = $libelle;
                $lesson['resume'] = $resume;

                FlashController::addFlash("La leçon a été mise à jour", 'success');
                $this->redirect('lessons');

            }
        }

        $this->render('lessons/formulaire', array(
            'lesson'        =>  $lesson,
            'categories'    =>  $categories,
            'id_categorie'  =>  $lesson['id_categorie'],
            'mode'          =>  'modif',
        ));

    }

    public function remove($id) {
        $model = new LessonsModel();
        $model->delete($id);
        FlashController::addFlash("La leçon a été supprimée", "success");
        $this->redirect('lessons');
    }

}
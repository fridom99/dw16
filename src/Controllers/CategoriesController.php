<?php  
namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\CategoriesModel;

class CategoriesController extends Controller {
    
    public function index() {
        $model = new CategoriesModel();
        $result = $model->findAll();
        $categories = $result->fetchAll();
        $this->render('categories/liste', array(
            'categories'    =>  $categories,
            'titre'         =>  'Catégories',
            'description'   =>  'description SEO friendly',
        ));
    }

    public function show($id) {
        $model = new CategoriesModel();
        $categorie = $model->find($id)->fetch();
        $this->render('categories/fiche', array('categorie' => $categorie));
    }


    public function add() {
        if( $_SERVER['REQUEST_METHOD']=='POST') {

            extract($_POST);

            if(empty($libelle)) { FlashController::addFlash("Le libellé est obligatoire", 'danger'); }

            $libelle = htmlentities(strip_tags($libelle));

            if(empty($_SESSION['messages'])) {
                $model = new CategoriesModel();
                $model->add(array(
                    'libelle'   =>  $libelle,
                ));
                FlashController::addFlash('La catégorie ' . $libelle .' a été ajoutée');
                $this->redirect('categories');
            }


        }
        $this->render('categories/formulaire', array(
            'categorie'     =>  $_POST,
            'mode'          =>  'ajout',
        ));
    }
    public function modify($id) {
        $model = new CategoriesModel();
        $categorie = $model->find($id)->fetch();
        if($_SERVER['REQUEST_METHOD']=='POST') {

            extract($_POST);

            if(empty($libelle)) { FlashController::addFlash("Le libellé est obligatoire", 'danger'); }

            $libelle = htmlentities(strip_tags($libelle));

            if(empty($_SESSION['messages'])) {
                $model->update(array(
                    'id'        =>  $id,
                    'libelle'   =>  $libelle,
                ));
                $categorie['libelle'] = $libelle;

                FlashController::addFlash("La catégorie a été mise à jour", 'success');
                $this->redirect('categories');
            }

        }

        $this->render('categories/formulaire', array(
            'categorie'     =>  $categorie,
            'mode'          =>  'modif',
        ));
    }
    
    public function remove($id) {
        $model = new CategoriesModel();
        $model->delete($id);
        FlashController::addFlash("La catégorie a été supprimée", "success");
        $this->redirect('categories');
    }

}
<?php 

namespace App\Controllers;

use App\Controllers\Controller;

class HomeController extends Controller {

    public function index() {
        // require ROOT . '/src/Views/home/homepage.php';
        $this->render('home/homepage');
    }

}
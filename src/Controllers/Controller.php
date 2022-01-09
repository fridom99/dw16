<?php 
namespace App\Controllers;

/**
 * Controller général
 * Permet de regrouper des méthodes communes aux autres controllers (controllers spécialisés)
 */
abstract class Controller {

    /**
     * Méthode permettant d'inclure les vues dans un template global
     *
     * @param string $template vue à inclure
     * @param array $data données utilisées par la vue
     * @return void
     */
    public function render(string $template, array $data = []) {
        
        extract($data);
        
        /** Début de bufferisation de la sortie */
        ob_start();  
        
        require ROOT . '/src/Views/' . $template . '.php';
        
        /** Fin de bufferisation de la sortie et stckage du contenu du buffer dans $content */
        $content = ob_get_clean();
        require ROOT . '/src/Views/default.php';
    }

    /** A détailler */
    public function redirect($destination) {
        // header('Location: http://localhost/projet/' . $destination );
        header('Location: ' . BASE_URL .$destination );
        exit;
    }
    
}
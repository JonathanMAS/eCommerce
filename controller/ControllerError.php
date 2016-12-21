<?php
    
    class ControllerError {
        public static function view(){
            $commandes = ModelCommande::selectAll();
            $controller='error';
            $pagetitle='Erreur';
            $view=htmlspecialchars($_GET['view']);
            require File::build_path(array('view','view.php'));
        }
        public static function errorPage(){
            $controller='error';
            $pagetitle='Contacter Administrateur';
            $view='error';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
    }
    ?>

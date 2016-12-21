<?php
    class ControllerPrincipal {
        public static function accueil() {
            $controller='vitrine';
            $view='accueil';
            $pagetitle='Evobrain';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        
        public static function error() {
            $controller='error';
            $view='error';
            $pagetitle='Erreur';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        
        
        public static function connexion() {
            if(Session::getObject("user")!=NULL){
                if(Session::getObject("user")->isAdmin()){
                    $controller='admin';
                    $view='connected';
                    $pagetitle='Gestion';
                }else{
                    $controller='utilisateur';
                    $view='connected';
                    $pagetitle='Gestion';
                }
            }else{
                $controller='vitrine';
                $view='connexion';
                $pagetitle='Se Connecter';
            }
            if(isset($_GET['controller_go'])){
                $controller_go= $_GET['controller_go'];
                $action_go= $_GET['action_go'];
            }else{
                $controller_go= "";
                $action_go= "";
            }
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        
        
        public static function presentationEquipe() {
            $controller='team';
            $view='presentationEquipe';
            $pagetitle='Evobrain';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        
        public static function contact(){
            $controller='team';
            $view='contact';
            $pagetitle='Contactez nous';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        
        public static function contacted(){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mail = $_POST['mail'];
            $cp = $_POST['cp'];
            $date = $_POST['date'];
            $pays= $_POST['pays'];
            $entendu=$_POST['entendu'];
            $objet=$_POST['objet'];
            $message=$_POST['message'];
            if(Mail::send($nom,$prenom,$mail,$cp,$date,$pays,$entendu,$objet,$message)){
                $controller='success';
                $view='success_contact';
                $pagetitle='Team contactée!';
            }else{
                $controller='error';
                $view='error';
                $pagetitle='Contacter Administrateur';
            }
            require File::build_path(array('view','view.php'));
            
        }
        
        public static function nousRejoindre(){
            $controller='team';
            $view='nousRejoindre';
            $pagetitle='Rejoignez nous !';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        
        public static function presentation() {
            $controller='vitrine';
            $view='presentation';
            $pagetitle='Présentation des M.S.G.';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function videoPresentation() {
            $controller='vitrine';
            $view='videoPresentation';
            $pagetitle='Vidéo de présentation des M.S.G.';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function presse() {
            $controller='vitrine';
            $view='presse';
            $pagetitle='Presse';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function faq() {
            $controller='vitrine';
            $view='faq';
            $pagetitle='Foire aux questions';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
    }
    ?>

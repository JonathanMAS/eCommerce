<?php
    require_once File::build_path(array('model','ModelProduit.php')); // chargement du modèle
    require_once File::build_path(array('lib','Tools.php')); // chargement du modèle
    
    class ControllerProduit {
        
        /**
         Vérifie si la sécurité de l'accès à une vue. Par défaut on est au plus restrictif il faut etre admin pour etre accepté
         @param $noAdminAccepted false signifie qu'il faut être admin pour que ce soit sécurisé
         @return renvoie false si une erreur est détectée et s'occupe d'afficher l'erreur, renvoie 1 pour un accès admin, 2 pour un accès pas admin
         */
        private static function secure($noAdminAccepted=false){
            if(Session::getObject('user')!=NULL){ //si l'utilisateur est connecté
                
                if(Session::getObject('user')->isAdmin()){ //si l'user est un admin
                    
                    return 1;
                    
                }else{ //si le user n est pas admin
                    if($noAdminAccepted){ //si la vue est sécurisé même si on est pas admin, pas besoin de faire d'erreur
                        return 2;
                    } else {
                        $controller='error';
                        $pagetitle='Accès interdit';
                        $view='errorNoAccess';
                    }
                    
                }
                
                
            } else{ //si l'utilisateur n'est pas connecté
                $controller='error';
                $pagetitle='Veuillez vous connecter';
                $view='errorSessionClosed';
            }
            
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
            return false;
        }
        
        public static function readAll() { //sécurisé
            
            
            $user = Session::getObject('user');
            
            if($user != false){
                $admin= $user->isAdmin();
            } else {
                $admin = false;
            }
            
            $tab_p = ModelProduit::selectAll();     //appel au modèle pour gerer la BD
            $controller='boutique';
            $view='list';
            $pagetitle='Liste des produits';
            
            
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        
        
        public static function read() { //l'accès au produit est autorisé pour tout le monde
            if(isset($_GET['product'])){
                $id= $_GET['product'];
            }else{
                $id=null;
            }
            
            $p = ModelProduit::select($id);     //appel au modèle pour gerer la BD
            if($p!=false){
                $controller='boutique';
                $view='detail';
                $pagetitle='Detail du produits';
                
                $id_p = htmlspecialchars($p->getId_p());
                $nom_p = htmlspecialchars($p->getNom_p());
                $prix_p = htmlspecialchars($p->getPrix_p());
                $descr_p = htmlspecialchars($p->getDescription_p());
                $descr_d_p = htmlspecialchars($p->getDescription_detail_p());
                $img_p = htmlspecialchars($p->getImage_p());
            }else{
                $controller='error';
                $view='error';
                $pagetitle='Contacter Administrateur';
            }
            
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        
        public static function update() {
            
            if(isset($_GET['product'])){
                $id= $_GET['product'];
            }else{
                $id= null;
            }
            
            if(ControllerProduit::secure() != false) {
                
                if($id != NULL){
                    $p = ModelProduit::select($id);
                    $formTitle="Modifier";
                    $hiddenValue="updated";
                    $pagetitle = "Modifier produit";
                    $id = htmlspecialchars($p->getId_p());
                    $nom = htmlspecialchars($p->getNom_p());
                    $desc = htmlspecialchars($p->getDescription_p());
                    $prix = htmlspecialchars($p->getPrix_p());
                    $descD = htmlspecialchars($p->getDescription_detail_p());
                    $img = htmlspecialchars($p->getImage_p());
                }else{
                    $formTitle="Créer";
                    $hiddenValue="created";
                    $pagetitle = "Créer produit";
                    $id = "";
                    $nom = "";
                    $desc = "";
                    $prix = "";
                    $descD = "";
                    $img = "";
                    
                }
                
                $controller='boutique';
                $view='update';
                require File::build_path(array('view','view.php'));
            }
        }
        
        public static function updated(){
            if(ControllerProduit::secure() != false) { //errorPage()
                if(!isset($_POST["nom"]) || !isset($_POST["desc"]) || !isset($_POST["prix"]) || !isset($_POST["descD"])){
                    ControllerError::errorPage();
                    return false;
                }
                
                $array = array(
                               "nom_p" => $_POST["nom"],
                               "description_p" => $_POST["desc"],
                               "prix_p" => $_POST["prix"],
                               "description_detail_p" => $_POST["descD"],
                               );
                $image_define= false;
                if($_FILES['img']['name']!=""){
                    $array["image_p"] = $_FILES['img']['name'];
                    if(!Tools::upload('img','style/img/boutique/produits/'.$_FILES['img']['name'],1048576,array('png','gif','jpg','jpeg'))){
                        $controller='error';
                        $pagetitle='Contacter Administrateur';
                        $view='error';
                        require File::build_path(array('view','view.php'));
                    }
                    $image_define=true;
                }
                
                $user=Session::getObject("user");
                
                if($_POST['action_bis'] == "created"){
                    $switchVar=-1;
                    if($image_define){
                        $p= new ModelProduit(0,$_POST["nom"],$_POST["desc"],$_POST["prix"],$_POST["descD"],$_FILES['img']['name']);
                        $switchVar = $p->save();
                    }
                    switch($switchVar){
                        case 0:
                            $controller='success';
                            $pagetitle='Produit créé';
                            $view= 'productCreated';
                            break;
                        case -2:
                            $controller='error';
                            $pagetitle='Le produit existe déjà?';
                            $view='errorCreateProduct';
                            break;
                        case -1:
                            $controller='error';
                            $pagetitle='Contacter Administrateur';
                            $view='error';
                            break;
                    }
                    
                }else{
                    $p= new ModelProduit($_POST['id'],$_POST["nom"],$_POST["desc"],$_POST["prix"],$_POST["descD"],$_FILES['img']['name']);
                    $switchVar = $p->update($array,$_POST["id"]);
                    switch($switchVar){
                        case true:
                            $controller='success';
                            $pagetitle='Produit mis à jour';
                            $view= 'productUpdated';
                            break;
                        case false:
                            $controller='error';
                            $pagetitle='Contacter Administrateur';
                            $view='error';
                            break;
                    }
                }
                
                require File::build_path(array('view','view.php'));
            }
        }
        
        
        public static function delete(){
            if(ControllerProduit::secure() != false) {
                if(!isset($_GET["product"])){
                    ControllerError::errorPage();
                    return false;
                }
                $id= $_GET['product'];
                $controller='boutique';
                $pagetitle='Supprimer le produit';
                $view='delete';
                require File::build_path(array('view','view.php'));
            }
        }
        
        public static function deleted(){
            if(ControllerProduit::secure() != false) {
                if(!isset($_GET["id"])){
                    ControllerError::errorPage();
                    return false;
                }
                $id= $_GET['id'];
                if(ModelProduit::delete($id)){
                    $controller='success';
                    $pagetitle='Suppression avec succès';
                    $view='productDeleted';
                }else{
                    $controller='error';
                    $pagetitle='Contacter Administrateur';
                    $view='error';
                }
                require File::build_path(array('view','view.php'));
            }
        }
    }
    ?>

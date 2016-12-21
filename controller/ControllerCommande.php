<?php
    require_once File::build_path(array('model','ModelCommande.php')); // chargement du modèle
    require_once File::build_path(array('model','ModelContenir.php')); // chargement du modèle
    
    class ControllerCommande {
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
        
        public static function readAll(){ // Securisé
            
            if(ControllerCommande::secure() != false){
                $commandes = ModelCommande::selectAll();
                $controller='commande';
                $pagetitle='Liste des commandes';
                $view='list';
                require File::build_path(array('view','view.php'));
            }
        }
        
        public static function read(){ // Securisé
            
            //ModelCommande
            $commande = ModelCommande::select($_GET['commande']);
            $id_command = $commande->getId();
            $produits = ModelCommande::selectProduits($commande->getId());
            $nbProduit = count($produits);
            
            if($commande != false){
                $isSecure = ControllerCommande::secure(true);
                if($isSecure != false){
                    if($isSecure == 1){
                        $controller='commande';
                        $pagetitle='Editer Commande';
                        $view='detailAdmin';
                    } else if($isSecure == 2){
                        if($commande->getIdClient()==Session::getObject('user')->getId_c()){
                            $controller='commande';
                            $pagetitle='Récapitulatif commandes';
                            $view='detail';
                        }else{
                            $controller='error';
                            $pagetitle='Accès interdit';
                            $view='errorNoAccess';
                        }
                    }
                    require File::build_path(array('view','view.php'));
                }
                
            } else {
                $controller='error';
                $pagetitle='Commande not found';
                $view='errorCommandeNotFound';
                
                require File::build_path(array('view','view.php'));
            }
            
        }
        
        public static function delete(){
            $id= $_GET['commande'];
            
            if(ModelCommande::select($_GET['commande'])){
                
                if(ControllerCommande::secure() != false){
                    $controller='commande';
                    $pagetitle='Supprimer la commande';
                    $view='delete';
                    
                    require File::build_path(array('view','view.php'));
                }
            } else {
                $controller='error';
                $pagetitle='Commande not found';
                $view='errorCommandeNotFound';
                
                require File::build_path(array('view','view.php'));
            }
            
        }
        
        public function deleted(){
            if(ControllerCommande::secure() != false){
                $idCommande = htmlspecialchars($_GET['id']);
                if(ModelCommande::delete($idCommande)){
                    $controller='success';
                    $pagetitle='Suppression avec succès';
                    $view='successCommandeDeleted';
                }else{
                    $controller='error';
                    $pagetitle='Contacter Administrateur';
                    $view='error';
                }
                
                require File::build_path(array('view','view.php'));
            }
        }
        
        public static function deleteProduit(){
            if(ControllerCommande::secure() != false){
                $idProduit= htmlspecialchars($_GET['product']);
                $idCommande = htmlspecialchars($_GET['commande']);
                $controller='commande';
                $pagetitle='Supprimer la commande';
                $view='deleteProduit';
                require File::build_path(array('view','view.php'));
            }
        }
        
        public static function deletedProduit(){
            if(ControllerCommande::secure() != false){
                $idProduit= htmlspecialchars($_GET['product']);
                $idCommande = htmlspecialchars($_GET['commande']);
                $commande = ModelCommande::select($idCommande);
                
                $c = new ModelContenir($idCommande, $idProduit, 0);
                if($c->delete($idCommande, $idProduit)){
                    $controller='success';
                    $pagetitle='Suppression avec succès';
                    $view='successDeleteProduitCommande';
                }else{
                    $controller='error';
                    $pagetitle='Contacter Administrateur';
                    $view='error';
                }
                require File::build_path(array('view','view.php'));
            }
        }
        
        public static function modifierQteDansCommande(){
            if(ControllerCommande::secure() != false){
                $command = $_GET['command'];
                $produit= $_GET['produit'];
                $qte = $_GET['qte'];
                $produits = ModelCommande::selectProduits($command);
                $nbProduit = count($produits); 
                if($nbProduit>=1&&$qte>=1){
                    ModelCommande::modifierQTeProduit($command,$produit,$qte);
                    header("Location: index.php?controller=commande&action=read&commande=".$command);
                }else{
                    ModelCommande::delete($command);
                    header("Location: index.php?controller=commande&action=readAll");
                }
            }
        }
        
        
    }
    ?>

<?php
    require_once File::build_path(array('model','ModelPanier.php')); // chargement du modèle
    
    class ControllerPanier {
        
        public static function creationPanier(){
            new ModelPanier();
            return true;
        }
        
        public static function ajouterAuPanier(){
            if(isset($_GET['product'])){
                $id=$_GET['product'];
            }else{
                $id=null;
            }
            
            if(isset($_GET['qte'])){
                $qte=$_GET['qte'];
            }else{
                $qte=null;
            }
            
            if($id!=null&$qte!=null){
                if(ModelPanier::addProduit($id,$qte)){
                    header("Location: index.php?controller=panier&action=readAll");
                }
            }
        }
        
        public static function viderPanier(){
            if(ModelPanier::supprimePanier()){
                header("Location: index.php?controller=panier&action=readAll");
            }
        }
        
        public static function suppDuPanier(){
            if(isset($_GET['product'])){
                $id=$_GET['product'];
            }else{
                $id=null;
            }
            if($id!=null){
                if(ModelPanier::delProduit($id)){
                    header("Location: index.php?controller=panier&action=readAll");
                }
            }
        }
        
        public static function modifierQteDansPanier(){
            if(isset($_GET['product'])){
                $id=$_GET['product'];
            }else{
                $id=null;
            }
            
            if(isset($_GET['qte'])){
                $qte=$_GET['qte'];
            }else{
                $qte=null;
            }
            
            if($id!=null&$qte!=null){
                if(ModelPanier::modifierQTeProduit($id,$qte)){
                    header("Location: index.php?controller=panier&action=readAll");
                }
            }
        }
        
        public static function readAll(){
            $panier = Cookie::getObject('panier');
            $nbProduitPanier = ModelPanier::nbProduitDifferent();
            $montant = ModelPanier::montant();
            $controller='';
            $view='panier';
            $pagetitle='Panier';
            require File::build_path(array('view','view.php'));
        }
        
        public static function save(){
            if(Session::getObject('user')!=NULL){
                $panier = Cookie::getObject('panier');
                $today = getdate();
                $date = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
                $command = new ModelCommande(0,Session::getObject('user')->getId_c(), $date,$panier['Produit'],$panier['qteProduit'] );
                $id_command = $command->save();
                if($id_command>0){
                    $controller='commande';
                    $pagetitle='Commande validée';
                    $view='create';
                    $commande= ModelCommande::select($id_command);
                    $produits = ModelCommande::selectProduits($id_command);
                    $nbProduit = count($produits); 
                }else{
                    $controller='error';
                    $pagetitle='Contacter l\'administrateur';
                    $view='error';
                }
            }else{
                header("Location: index.php?controller=principal&action=connexion&controller_go=panier&action_go=save");
            }
            require File::build_path(array('view','view.php'));
        }
        
    }
    ?>

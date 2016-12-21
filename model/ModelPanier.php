<?php
    require_once File::build_path(array('model','ModelProduit.php')); // chargement du modèle
    
    class ModelPanier {
        private static $time = 3600;
        
        public function __construct() {
            if (!self::exist()){
                $panier=array();
                $panier['Produit'] = array();
                $panier['qteProduit'] = array();
                $panier['verrou'] = false;
                if(!self::exist()){
                    Cookie::setObject('panier',$panier,static::$time);
                }
                unset($panier);
            }
            return true;
        }
        
        public static function addProduit($id,$qteProduit){
            $panier = Cookie::getObject('panier');
            //Si le panier existe
            if (ModelPanier::exist() && !ModelPanier::isVerrouille())
            {
                //Si le produit existe déjà on ajoute seulement la quantité
                $positionProduit = array_search($id,  $panier['Produit']);
                
                if ($positionProduit !== false)
                {
                    $panier['qteProduit'][$positionProduit] += $qteProduit ;
                }
                else
                {
                    //Sinon on ajoute le produit
                    array_push( $panier['Produit'],$id);
                    array_push( $panier['qteProduit'],$qteProduit);
                }
                Cookie::setObject('panier',$panier,static::$time);
                unset($panier);
                return true;
            }else{
                echo "Un problème est survenu veuillez contacter l'administrateur du site.";
            }
        }
        
        function delProduit($id){
            //Si le panier existe
            if (ModelPanier::exist() && !ModelPanier::isVerrouille())
            {
                $panier=Cookie::getObject('panier');
                //Nous allons passer par un panier temporaire
                $tmp=array();
                $tmp['Produit'] = array();
                $tmp['qteProduit'] = array();
                $tmp['verrou'] = $panier['verrou'];
                
                for($i = 0; $i < count($panier['Produit']); $i++)
                {
                    if ($panier['Produit'][$i] !== $id)
                    {
                        array_push( $tmp['Produit'],$panier['Produit'][$i]);
                        array_push( $tmp['qteProduit'],$panier['qteProduit'][$i]);
                    }
                    
                }
                //On remplace le panier en cookie par notre panier temporaire à jour
                $panier =  $tmp;
                Cookie::setObject('panier',$panier,static::$time);
                //On efface notre panier temporaire
                unset($tmp);
                unset($panier);
                return true;
            }
            else
                echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }
        
        public static function montant(){
            $panier= Cookie::getObject('panier');
            $total=0;
            for($i = 0; $i < count($panier['Produit']); $i++)
            {
                $produit = ModelProduit::select($panier['Produit'][$i]);
                $total +=  $panier['qteProduit'][$i]* $produit->getPrix_p();
            }
            return $total;
        }
        
        public static function nbProduitDifferent(){
            $panier= Cookie::getObject('panier');
            if (self::exist()){
                return count($panier['Produit']);
            }else{
                return 0;
            }
        }
        
        public static function qteProduit($id){
            $i=0;
            $panier = Cookie::getObject('panier');
            while(($panier['Produit'][$i] != $id)&&($i < count($panier['Produit']) )){
                $i++;
            }
            if($panier['Produit'][$i] == $id){
                return $panier['qteProduit'][$i];
            }else{
                return false;
            }
        }
        
        function modifierQTeProduit($id,$qteProduit){
            
            $panier = Cookie::getObject('panier');
            //Si le panier éxiste
            if (ModelPanier::exist() && !ModelPanier::isVerrouille())
            {
                //Si la quantité est positive on modifie sinon on supprime l'article
                if ($qteProduit > 0)
                {
                    //Recharche du produit dans le panier
                    $positionProduit = array_search($id,  $panier['Produit']);
                    
                    if ($positionProduit !== false)
                    {
                        $panier['qteProduit'][$positionProduit] = $qteProduit ;
                    }
                }else{
                    self::delProduit($id);
                }
                Cookie::setObject('panier',$panier,static::$time);
                return true;
                unset($panier);
            }else
                echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }
        public static function supprimePanier(){
            Cookie::deleteCookie('panier');
            return true;
        }
        
        public static function isVerrouille(){
            $panier= Cookie::getObject('panier');
            return $panier['verrou'] == true;
        }
        
        public static function exist(){
            if(Cookie::getObject('panier')!=NULL){
                return true;
            }else{
                return false;
            }
        }
    }
    
    ?>

<?php
    require_once File::build_path(array('model','Model.php'));
    
    class ModelCommande extends Model{
        protected static $object ="commande";
        protected static $primary ="id";
        
        private $id;
        private $idClient;
        private $dateCommande;
        
        private $produits; //tableau d'id des produits de la commande
        private $qte_produit; //tableau avec les quantités des produits de la commande
        
        // un getter
        public function getId() {
            return $this->id;
        }
        // un setter
        public function setId($id) {
            $this->id = $id;
        }
        
        // un getter
        public function getProduits() {
            return $this->qte_produit;
        }
        
        // un getter
        public function getQte_produit() {
            return $this->produits;
        }
        
        // un getter
        public function getIdClient() {
            return $this->idClient;
        }
        // un setter
        public function setIdClient($idClient2) {
            $this->idClient = $idClient2;
        }
        
        // un getter
        public function getDateCommande() {
            return $this->dateCommande;
        }
        
        // un setter
        public function setDateCommande($dateCommande) {
            $this->dateCommande = $dateCommande;
        }
        
        
        // id_produit est un array avec tous les id des produits, et qte_produits un array avec leur quantité
        public function __construct($id = NULL, $idClient = NULL, $dateCommande = NULL, $id_produit = NULL, $qte_produits = NULL) {
            if( !is_null($idClient) && !is_null($dateCommande) && !is_null($id_produit) && !is_null($qte_produits)) {
                //$this->id = $this->getNewId();
                $this->id= $id;
                $this->idClient = $idClient;
                $this->dateCommande = $dateCommande;
                $this->produits = $id_produit;
                $this->qte_produit = $qte_produits;
                
            }
        }
        
        public static function modifierQTeProduit($command,$produit,$qte){
            if($qte>0){
                $c = ModelContenir::select($command, $produit);
                $c->setQte_produit($qte);
                $c->update();
            }else{
                ModelContenir::delete($command,$produit);
            }
            return true;
        }
        
        public static function delete($primary) {
            $retour = 0;
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $class_name = "Model".ucfirst(static::$object);
            $primary_key = static::$primary;
            
            try {
                $sql = "DELETE FROM $table_name WHERE $primary_key=:primary_key";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                                "primary_key" => $primary
                                );
                $req_prep->execute($values);
                $retour = true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                $retour = false;
            }
            
            if($retour){ //on supprime la commande de la base de donnée, mais aussi ses produits qu'elle contient
                
                $table_name = "PS3_PHP_".strtoupper(static::$object);
                $class_name = "Model".ucfirst(static::$object);
                $primary_key = static::$primary;
                
                try {
                    $sql = "DELETE FROM PS3_PHP_CONTENIR WHERE id_commande=:primary_key";
                    $req_prep = Model::$pdo->prepare($sql);
                    $values = array(
                                    "primary_key" => $primary
                                    );
                    $req_prep->execute($values);
                    return true;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    return false;
                }
            } else {
                return false;
            }
            
        }
        
        public function save(){ //on save ET la commande, ET les produits qu'elle contient
            
            $retour = 0;
            
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $columnStr = "";
            $valueStr = "";
            $values = array();
            
            $reflect = new ReflectionObject($this);
            foreach ($reflect->getProperties(ReflectionProperty::IS_PRIVATE) as $prop) {
                $temp = $prop->getName();
                if($temp != 'produits' && $temp != 'qte_produit'){
                    $col=$temp;
                    $columnStr.="$col, ";
                    $valueStr.=":$col, ";
                    $get = "get".ucfirst($col);
                    //    echo $this->$get();
                    $values[$col]=$this->$get();
                }
                
            }
            
            $columnStr = substr($columnStr, 0, -2);
            $valueStr = substr($valueStr, 0, -2);
            
            try {
                Model::$pdo->beginTransaction();
                $sql = "INSERT INTO $table_name ($columnStr) VALUES ($valueStr)";
                $req_prep = Model::$pdo->prepare($sql);
                $req_prep->execute($values);
                $retour = Model::$pdo->lastInsertId();
                Model::$pdo->commit();
                $this->id=$retour;
                
            } catch (PDOException $e) {
                Model::$pdo->rollBack();
                if ($e->getCode() != 23000) {
                    echo $e->getMessage();
                    $retour = -1;
                } else {
                    echo $e->getMessage();
                    $retour = -2;
                }
            }
            
            if($retour >= 0){
                $i = 0;
                
                foreach($this->produits as $p){
                    $c = new ModelContenir($this->id, $this->produits[$i],  $this->qte_produit[$i]);
                    
                    
                    if(($r = $c->save()) < 0){
                        return $r-3;//pour différencier les erreurs de contenir ou de commande
                    }
                    $i++;
                }
                
            } else {
                return -3;
            }
            return $retour;
        }
        
        public static function getCommandes($id_c = NULL){
            ModelCommande::$primary= 'idClient';
            $tab = ModelCommande::selectResults($id_c);
            ModelCommande::$primary= 'id';
            return $tab;
        }
        
        public static function selectNbProduit($idCommande, $idProduit){
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $class_name = "Model".ucfirst(static::$object);
            $primary_key = static::$primary;
            
            try {
                $sql = "SELECT c.qte_produit ".
                "FROM PS3_PHP_CONTENIR c ".
                "JOIN PS3_PHP_COMMANDE com ON com.id = c.id_commande ".
                "WHERE c.id_commande=:idCommande ".
                "AND c.id_produit=:idProduit";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                                "idCommande" => $idCommande,
                                "idProduit" =>$idProduit
                                );
                
                $req_prep->execute($values);
                //$req_prep->setFetchMode(PDO::FETCH_CLASS, "PS3_PHP_PRODUIT");
                $tab= $req_prep->fetch(PDO::FETCH_ASSOC);
                
                if (empty($tab))
                    return false;
                return intval($tab['qte_produit']);
                
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
        }
        
        public static function selectProduits($idCommande) {
            
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $class_name = "Model".ucfirst(static::$object);
            $primary_key = static::$primary;
            
            try {
                $sql = "SELECT * ".
                "FROM PS3_PHP_PRODUIT p ".
                "JOIN PS3_PHP_CONTENIR c ON c.id_produit = p.id_p ".
                " WHERE c.id_commande=:idCommande";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                                "idCommande" => $idCommande
                                );
                
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelProduit");
                $tab= $req_prep->fetchAll();
                
                if (empty($tab))
                    return false;
                return $tab;
                
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
        }
        
        public static function montant($idCommande){
            $commandes = ModelCommande::selectProduits($idCommande);
            $retour = false;
            if($commandes != false){
                $prix = 0;
                foreach($commandes as $p){
                    $prix += $p->getPrix_p();
                }
                $retour = $prix;
            } 
            echo "PRIXXX:";
            //   var_dump($retour);
            //  var_dump($commandes);
            return $retour;
        }
        
    }
    
    
    
    ?>

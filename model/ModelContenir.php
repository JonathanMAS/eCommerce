<?php
    require_once File::build_path(array('model','Model.php'));
    
    class ModelContenir extends Model {
        protected static $object ="contenir";
        protected static $primary ="id_commande";
        
        private $id_commande;
        private $id_produit;
        private $qte_produit;
        
        // un getter
        public function getId_commande() {
            return $this->id_commande;
        }
        // un setter
        public function setId_commande($id_commande) {
            $this->id_commande = $id_commande;
        }
        
        // un getter
        public function getId_produit() {
            return $this->id_produit;
        }
        // un setter
        public function setId_produit($id_produit) {
            $this->id_produit = $id_produit;
        }
        
        // un getter
        public function getQte_produit() {
            return $this->qte_produit;
        }
        
        // un setter
        public function setQte_produit($qte_produit) {
            $this->qte_produit = $qte_produit;
        }
        
        public function __construct($id_commande = NULL, $id_produit = NULL, $qte_produit = NULL) {
            if(!is_null($id_commande) && !is_null($id_produit) && !is_null($qte_produit)) {
                $this->id_commande = $id_commande;
                $this->id_produit = $id_produit;
                $this->qte_produit = $qte_produit;
            }
        }
        
        
        public static function select($id_com, $id_p) {
            
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $class_name = "Model".ucfirst(static::$object);
            
            try {
                $sql = "SELECT * from PS3_PHP_CONTENIR WHERE id_commande=:id_com AND id_produit=:id_p";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                                "id_com" => $id_com,
                                "id_p" => $id_p
                                );
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
                $tab= $req_prep->fetchAll();
                
                if (empty($tab))
                    return false;
                return $tab[0];
                
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
        }
        
        
        public static function selectResults($id_com, $id_p) {
            
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $class_name = "Model".ucfirst(static::$object);
            
            try {
                $sql = "SELECT * from PS3_PHP_CONTENIR WHERE id_commande=:id_com AND id_produit=:id_p";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                                "id_com" => $id_com,
                                "id_p" => $id_p
                                );
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
                $tab= $req_prep->fetchAll();
                
                if (empty($tab))
                    return false;
                return $tab;
                
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
        }
        
        public static function delete($id_com, $id_p) {
            
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $class_name = "Model".ucfirst(static::$object);
            $primary_key = static::$primary;
            
            try {
                $sql = "DELETE FROM PS3_PHP_CONTENIR WHERE id_commande=:id_com AND id_produit=:id_p";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                                "id_com" => $id_com,
                                "id_p" => $id_p
                                );
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        
        public function update(){
            $id_com = $this->id_commande;
            $id_p = $this->id_produit;
            $qte = $this->qte_produit;
            //   var_dump($this);
            try {
                $sql = "UPDATE PS3_PHP_CONTENIR SET qte_produit=:qte WHERE id_commande=:id_com AND id_produit=:id_p;";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                                "id_com" => $id_com,
                                "id_p" => $id_p,
                                "qte" => $qte
                                );
                $req_prep->execute($values);
                return true;
                
            }catch (PD0Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
        
    }
    ?>

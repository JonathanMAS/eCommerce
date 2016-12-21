<?php
    require_once File::build_path(array('config','Conf.php'));
    class Model {
        public static $pdo;
        
        
        public static function Init(){
            $hostname = Conf::getHostname();
            $database_name= Conf::getDatabase();
            $login=Conf::getLogin();
            $password=Conf::getPassword();
            
            try{
                // Connexion à la base de données
                // Le dernier argument sert à ce que toutes les chaines de caractères
                // en entrée et sortie de MySql soit dans le codage UTF-8
                self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                                     array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                
                // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
        }
        /*
         public static function getNewId(){
         $newId = rand(0, 10000);
         while(($k = self::select($newId)) != false){
         $newId = rand(0, 10000);
         }
         return $newId;
         }
         */
        public static function selectAll() {
            
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $class_name = "Model".ucfirst(static::$object);
            
            $rep = Model::$pdo->query("SELECT * FROM $table_name;");
            $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $rep->fetchAll();
            return $tab;
        }
        
        public static function select($primary_value) {
            
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $class_name = "Model".ucfirst(static::$object);
            $primary_key = static::$primary;
            
            try {
                $sql = "SELECT * from $table_name WHERE $primary_key=:primary_key";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                                "primary_key" => $primary_value
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
        
        /**
         Récupère le model dont la colonne attr vaut la valeur val. Attention, attr n'est pas protégé des entrées utilisateurs
         */
        public static function selectBy($attr, $val) {
            
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $class_name = "Model".ucfirst(static::$object);
            $primary_key = static::$primary;
            
            try {
                $sql = "SELECT * from $table_name WHERE $attr=:val";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                                "val" => $val
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
        
        public static function selectResults($primary_value) {
            
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $class_name = "Model".ucfirst(static::$object);
            $primary_key = static::$primary;
            
            try {
                $sql = "SELECT * from $table_name WHERE $primary_key=:primary_key";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                                "primary_key" => $primary_value
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
        
        public static function delete($primary) {
            
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
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        
        public function update($data,$by) {
            
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $class_name = "Model".ucfirst(static::$object);
            $primary_key = static::$primary;
            
            $values = array();
            $set="";
            
            foreach ($data as $key=>$value) {
                $set.="$key=:$key, ";
                $values[$key]=$value;
            }
            $set = substr($set, 0, -2);
            
            try {
                $sql = "UPDATE $table_name SET $set WHERE $primary_key='$by';";
                $req_prep = Model::$pdo->prepare($sql);
                $req_prep->execute($values);
                return true;
                
            }catch (PD0Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
        
        public function save() {
            
            $table_name = "PS3_PHP_".strtoupper(static::$object);
            $columnStr = "";
            $valueStr = "";
            $values = array();
            
            $reflect = new ReflectionObject($this);
            foreach ($reflect->getProperties(ReflectionProperty::IS_PRIVATE) as $prop) {
                $col=$prop->getName();
                $columnStr.="$col, ";
                $valueStr.=":$col, ";
                $get = "get".ucfirst($col);
                //    echo $this->$get();
                $values[$col]=$this->$get();
            }
            
            $columnStr = substr($columnStr, 0, -2);
            $valueStr = substr($valueStr, 0, -2);
            
            try {
                
                $sql = "INSERT INTO $table_name ($columnStr) VALUES ($valueStr)";
                $req_prep = Model::$pdo->prepare($sql);
                $req_prep->execute($values);
                return 0;
            } catch (PDOException $e) {
                if ($e->getCode() != 23000) {
                    echo $e->getMessage();
                    return -1;
                } else {
                    echo $e->getMessage();
                    return -2;
                }
            }
        }
    }
    Model::Init();
    
    ?>

<?php
    require_once File::build_path(array('model','Model.php'));
    
    class ModelUtilisateur extends Model{
        protected static $object ="utilisateur";
        protected static $primary ="mail_c";
        
        private $id_c;
        private $nom_c;
        private $prenom_c;
        private $date_naissance_c;
        private $sexe_c;
        private $pays_c;
        private $adresse_c;
        private $ville_c;
        private $code_postal_c;
        private $telephone_c;
        private $mail_c;
        private $password_c;
        private $admin;
        private $nonce_c;
        
        // un getter
        public function getId_c() {
            return $this->id_c;
        }
        
        // un getter
        public function getNom_c() {
            return $this->nom_c;
        }
        
        // un setter
        public function setNom_c($nom2) {
            $this->nom_c = $nom2;
        }
        
        // un getter
        public function getPrenom_c() {
            return $this->prenom_c;
        }
        
        // un setter
        public function setPrenom_c($prenom2) {
            $this->prenom_c = $prenom2;
        }
        
        
        // un getter
        public function getDate_naissance_c() {
            return $this->date_naissance_c;
        }
        
        // un setter
        public function setDate_naissance_c($date) {
            $this->date_naissance_c = $date;
        }
        
        
        // un getter
        public function getSexe_c() {
            return $this->sexe_c;
        }
        
        // un setter
        public function setSexe_c($s) {
            $this->sexe_c = $s;
        }
        
        // un getter
        public function getPays_c() {
            return $this->pays_c;
        }
        
        // un setter
        public function setPays_c($p) {
            $this->pays_c = $p;
        }
        
        // un getter
        public function getAdresse_c() {
            return $this->adresse_c;
        }
        
        // un setter
        public function setAdresse_c($a) {
            $this->$adresse_c = $a;
        }
        
        // un getter
        public function getVille_c() {
            return $this->ville_c;
        }
        
        // un setter
        public function setVille_c($v) {
            $this->$ville_c = $v;
        }
        // un getter
        public function getCode_postal_c() {
            return $this->code_postal_c;
        }
        
        // un setter
        public function setCode_postal_c($cp) {
            $this->$code_postal_c = $cp;
        }
        
        // un getter
        public function getTelephone_c() {
            return $this->telephone_c;
        }
        
        // un setter
        public function setTelephone_c($t) {
            $this->$telephone_c = $t;
        }
        
        // un getter
        public function getMail_c() {
            return $this->mail_c;
        }
        
        // un setter
        public function setMail_c($m) {
            $this->$code_postal_c = $m;
        }
        
        // un getter
        public function getPassword_c() {
            return $this->password_c;
        }
        
        // un setter
        public function setPassword_c($p) {
            $this->$password_c = $p;
        }
        
        // un getter
        public function getNonce_c() {
            return $this->nonce_c;
        }
        
        // un setter
        public function setNonce_c($n) {
            $this->nonce_c = $n;
        }
        
        public function isAdmin(){
            return $this->admin==1;
        }
        
        public function getAdmin(){
            return $this->admin;
        }
        
        public function setAdminValue($value, $mail){
            $r= ModelUtilisateur::update($array = array("admin" => $value), $mail);
            return $r;
        }
        
        
        // un constructeur
        public function __construct($id = NULL, $nom = NULL, $prenom= NULL, $date_naissance= NULL, $sexe= NULL, $pays= NULL, $adresse= NULL, $ville= NULL, $code_postal= NULL, $telephone= NULL, $mail= NULL, $password= NULL, $admin=NULL, $nonce=NULL) {
            if(!is_null($nom) && !is_null($prenom)&& !is_null($date_naissance)&& !is_null($sexe)&& !is_null($pays)&& !is_null($adresse)&& !is_null($ville)&& !is_null($code_postal)&& !is_null($mail)&& !is_null($password)&& !is_null($admin)) {
                $this->id_c = $id;
                $this->nom_c = $nom;
                $this->prenom_c = $prenom;
                // echo $date_naissance;
                $pos = strpos($date_naissance, '/');
                if($pos!=false){
                    list($day, $month, $year) = split('[/.-]',$date_naissance);
                    $this->date_naissance_c = $year.'-'.$month.'-'.$day;
                }else{
                    $this->date_naissance_c = $date_naissance;
                }
                $this->sexe_c = $sexe;
                $this->pays_c = $pays;
                $this->adresse_c = $adresse;
                $this->ville_c = $ville;
                $this->code_postal_c = $code_postal;
                $this->telephone_c = $telephone;
                $this->mail_c = $mail;
                $this->password_c = $password;
                $this->admin = $admin;
                $this->nonce_c = $nonce;
            }
        }
        
        
        public static function validate($nonce){
            ModelUtilisateur::$primary = 'nonce_c';
            $r= ModelUtilisateur::update($array = array("nonce_c" => NULL), $nonce);
            ModelUtilisateur::$primary = 'mail_c';
            return $r;
        }
        
        
    }
    
    
    
    ?>

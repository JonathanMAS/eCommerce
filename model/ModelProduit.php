<?php
    require_once File::build_path(array('model','Model.php'));
    class ModelProduit extends Model{
        protected static $object ="produit";
        protected static $primary ="id_p";
        
        private $id_p;
        private $nom_p;
        private $description_p;
        private $prix_p;
        private $description_detail_p ;
        private $image_p;
        
        
        // un getter
        public function getId_p() {
            return $this->id_p;
        }
        
        // un setter
        public function setId_p($id2) {
            $this->id_p = $id2;
        }
        
        // un getter
        public function getNom_p() {
            return $this->nom_p;
        }
        
        // un setter
        public function setNom_p($nom2) {
            $this->nom_p = $nom2;
        }
        
        // un getter
        public function getDescription_p() {
            return $this->description_p;
        }
        
        // un setter
        public function setDescription_p($descr2) {
            $this->description_p = $descr2;
        }
        
        // un getter
        public function getDescription_detail_p() {
            return $this->description_detail_p;
        }
        
        // un setter
        public function setDescription_detail_p($descr2) {
            $this->description_detail_p = $descr2;
        }
        
        // un getter
        public function getImage_p() {
            return $this->image_p;
        }
        
        // un setter
        public function setImage($image2) {
            $this->image_p = $image2;
        }
        
        // un getter
        public function getPrix_p() {
            return $this->prix_p;
        }
        
        // un setter
        public function setPrix_p($prix2) {
            $this->prix_p = $prix2;
        }
        
        public function __construct($id = NULL, $nom = NULL, $descr = NULL, $prix = NULL, $descr2 = NULL, $image = NULL) {
            if (!is_null($id) && !is_null($nom) && !is_null($descr)&& !is_null($prix)&& !is_null($descr2)&& !is_null($image)) {
                $this->id_p = $id;
                $this->nom_p = $nom;
                $this->description_p = $descr;
                $this->description_detail_p = $descr2;
                $this->prix_p = $prix;
                $this->image_p = $image;
            }
        }
        
        
    }
    ?>

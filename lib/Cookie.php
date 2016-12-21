<?php
    
    class Cookie {
        /*
         -Taille d'un cookie inferieur à 4KB
         -Les cookies doivent être définis avant tout code html
         */
        
        /**
         permet de créer un cookie
         @param name le nom du cookie
         @param value la valeur du cookie de type string
         @param expirationDelaySecond le temps en seconde avant la permenption du cookie.
         */
        public static function set($name, $value, $expirationDelaySecond){
            setcookie($name, $value, time()+$expirationDelaySecond);
        }
        /**
         permet de récuperer un cookie sous forme de string
         @param name le nom du cookie
         @return la valeur du cookie en string ou NULL s'il n'existe pas
         */
        public static function get($name){
            if(isset($_COOKIE[$name])){
                return $_COOKIE[$name];
            } else {
                return NULL;
            }
        }
        
        /**
         permet de créer un cookie à partir d'une valeur dont le type n'est pas string
         @param name le nom du cookie
         @param value la valeur du cookie de type string
         @param expirationDelaySecond le temps en seconde avant la permenption du cookie.
         */
        public static function setObject($name, $value, $expirationDelaySecond){
            $value = serialize($value);
            setcookie($name, $value, time()+$expirationDelaySecond);
        }
        /**
         permet de récuperer un cookie dans sa forme d'objet
         @param name le nom du cookie
         @return la valeur en objet du cookie ou NULL s'il n'existe pas
         */
        public static function getObject($name){
            $c = Cookie::get($name);
            if($c != NULL){
                return unserialize($c);
            }else{
                return NULL;
            }
        }
        
        /**
         supprime le cookie dont le nom est spécifié
         */
        public static function deleteCookie($name){
            setcookie($name, 0, time()-1);
            unset($_COOKIE[$name]);
        }
        
        /**
         supprime tous les cookie
         */
        public static function deleteAll(){
            foreach($_COOKIE as $key => $value){
                Cookie::deleteCookie($key);
            }
        }
    }
    
    ?>

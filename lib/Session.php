<?php
    
    class Session{
        /*
         -session start doit être appelé avant
         */
        public static function initSession(){
            session_start();
            /*
             //cas ou on veut faire expirer la session au bout d'un certain temps
             if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (30*60))) {
             // last request was more than 30 minutes ago
             session_unset();     // unset $_SESSION variable for the run-time
             session_destroy();   // destroy session data in storage
             }
             $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
             */
        }
        
        /**
         permet de définir une variable stocké dans la session
         @param varName le nom de la variable à définir
         @param varValue la valeur de la variable à définir
         */
        public static function set($varName, $varValue){
            $_SESSION[$varName] = $varValue;
        }
        
        /**
         permet récuperer une variable dont le nom est spécifié
         @param varName le nom de la variable à récuperer
         @return la valeur de la variable spécifié ou NULL si elle n'existe pas
         */
        public static function get($varName){
            if(isset($_SESSION[$varName])){
                return $_SESSION[$varName];
            } else {
                return NULL;
            }
        }
        
        
        /**
         permet de définir une variable stocké dans la session
         @param varName le nom de la variable à définir
         @param varValue la valeur de la variable à définir
         */
        public static function setObject($varName, $varValue){
            $_SESSION[$varName] = serialize($varValue);
        }
        
        /**
         permet récuperer une variable dont le nom est spécifié
         @param varName le nom de la variable à récuperer
         @return la valeur de la variable spécifié, NULL si elle n'existe pas, False si la désérialisation n'as pas fonctionné ou si la valeur sérialisé était false
         */
        public static function getObject($varName){
            if(isset($_SESSION[$varName])){
                return unserialize($_SESSION[$varName]);
            } else {
                return NULL;
            }
        }
        
        
        /**
         permet de supprimer la variable dont le nom est spécifié
         @param varName le nom de la variable à supprimer
         */
        public static function delete($varName){
            if(isset($_SESSION[$varName])){
                unset($_SESSION[$varName]);
                return true;
            } else {
                return false;
            }
        }
        
        /**
         supprime une session et toute ses variables
         */
        public static function deleteSession(){
            session_unset();     // unset $_SESSION variable for the run-time 
            session_destroy();   // destroy session data in storage
            setcookie(session_name(),'',time()-1); // deletes the session cookie containing the session ID
        }
    }
    
    ?>

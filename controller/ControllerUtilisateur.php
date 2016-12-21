<?php
    require_once File::build_path(array('model','ModelUtilisateur.php')); // chargement du modèle
    require_once File::build_path(array('lib','Security.php')); // chargement de la sécurité
    require_once File::build_path(array('lib','Mail.php')); // chargement de la lib Mail
    
    
    class ControllerUtilisateur {
        
        public static function create() { //securisé
            $mdpFalse=false;
            $nom="";
            $prenom="";
            $date_naissance="";
            $sexe="";
            $pays="";
            $adresse="";
            $ville="";
            $code_postal="";
            $telephone="";
            $mail="";
            $controller='vitrine';
            $pagetitle='S\'inscrire';
            $view='inscription';
            require File::build_path(array('view','view.php'));
        }
        
        public static function delete(){ //securisé
            if(!isset($_GET["mail"])){
                ControllerError::errorPage();
                return false;
            }
            $mail= rawurldecode($_GET['mail']);
            // ModelUtilisateur
            
            if(Session::getObject('user')!=NULL){ //si l'utilisateur est connecté
                
                $userMail = ModelUtilisateur::select($mail);
                
                if($userMail != false){ //si le mail existe
                    if(Session::getObject('user')->isAdmin()){ //si l'user est un admin
                        
                        $controller='utilisateur';
                        $pagetitle='Supprimer le compte';
                        $view='delete';
                    }else{ //si le user n est pas admin
                        if($mail==Session::getObject('user')->getMail_c()){ //si le user regarde son compte
                            
                            $controller='utilisateur';
                            $pagetitle='Supprimer le compte';
                            $view='delete';
                        }else{ //si le user regarde le compte de quelqu un d autre
                            $controller='error';
                            $pagetitle='Accès interdit';
                            $view='errorNoAccess';
                        }
                    }
                } else {//si le mail n'existe pas
                    $controller='error';
                    $pagetitle='Contacter administrateur';
                    $view="error";
                }
                
            } else{ //si l'utilisateur n'est pas connecté
                $controller='error';
                $pagetitle='Veuillez vous connecter';
                $view='errorSessionClosed';
            }
            
            require File::build_path(array('view','view.php'));
        }
        
        public static function deleted(){//securisé
            if(!isset($_GET["mail"])){
                ControllerError::errorPage();
                return false;
            }
            $mail= rawurldecode($_GET['mail']);
            
            if(Session::getObject('user')!=NULL){ //si l'utilisateur est connecté
                
                $userMail = ModelUtilisateur::select($mail);
                
                if($userMail != false){ //si le mail existe
                    if(Session::getObject('user')->isAdmin()){ //si l'user est un admin
                        
                        if(ModelUtilisateur::delete($mail)){
                            $controller='success';
                            $pagetitle='Suppression avec succès';
                            $view='accountDeleted';
                        }else{
                            $controller='error';
                            $pagetitle='Contacter Administrateur';
                            $view='error';
                        }
                    }else{ //si le user n est pas admin
                        if($mail==Session::getObject('user')->getMail_c()){ //si le user regarde son compte
                            
                            if(ModelUtilisateur::delete($mail)){
                                $controller='success';
                                $pagetitle='Suppression avec succès';
                                $view='accountDeleted';
                            }else{
                                $controller='error';
                                $pagetitle='Contacter Administrateur';
                                $view='error';
                            }
                        }else{ //si le user regarde le compte de quelqu un d autre
                            $controller='error';
                            $pagetitle='Accès interdit';
                            $view='errorNoAccess';
                        }
                    }
                } else {//si le mail n'existe pas
                    $controller='error';
                    $pagetitle='Contacter administrateur';
                    $view="error";
                }
                
            } else{ //si l'utilisateur n'est pas connecté
                $controller='error';
                $pagetitle='Veuillez vous connecter';
                $view='errorSessionClosed';
            }
            
            require File::build_path(array('view','view.php'));
            
        }
        
        public static function readAll() { //sécurisé
            
            if(Session::getObject('user')!=NULL){ //si l'utilisateur est connecté
                
                $id = Session::getObject('user')->getId_c();
                
                if(Session::getObject('user')->isAdmin()){ //si l'user est un admin
                    
                    $users = ModelUtilisateur::selectAll();
                    $controller='utilisateur';
                    $pagetitle='Liste des utilisateurs';
                    $view='list';
                    
                }else{ //si le user n est pas admin
                    $controller='error';
                    $pagetitle='Accès interdit';
                    $view='errorNoAccess';
                }
                
                
            } else{ //si l'utilisateur n'est pas connecté
                $controller='error';
                $pagetitle='Veuillez vous connecter';
                $view='errorSessionClosed';
            }
            
            require File::build_path(array('view','view.php'));
        }
        
        
        public static function created() { //sécurisé
            
            $nom="";
            $prenom="";
            $date_naissance="";
            $sexe="";
            $pays="";
            $adresse="";
            $ville="";
            $code_postal="";
            $telephone="";
            $mail="";
            $password="";
            $passwordConfirm="";
            
            if(isset($_POST['id'])){
                $id=$_POST['id'];
            }else if(isset($_GET['id'])){
                $id=$_GET['id'];
            }else{
                $id=0;
            }
            if(isset($_POST['nonce'])){
                $nonce=$_POST['nonce'];
            }else{
                $nonce=0;
            }
            if(isset($_POST['nom'])){
                $nom=$_POST['nom'];
            }
            if(isset($_POST['prenom'])){
                $prenom=$_POST['prenom'];
            }
            if(isset($_POST['date_naissance'])){
                $date_naissance=$_POST['date_naissance'];
            }
            if(isset($_POST['sexe'])){
                $sexe=$_POST['sexe'];
            }
            if(isset($_POST['pays'])){
                $pays=$_POST['pays'];
            }
            if(isset($_POST['adresse'])){
                $adresse=$_POST['adresse'];
            }
            if(isset($_POST['ville'])){
                $ville=$_POST['ville'];
            }
            if(isset($_POST['code_postal'])){
                $code_postal=$_POST['code_postal'];
            }
            if(isset($_POST['telephone'])){
                $telephone=$_POST['telephone'];
            }
            if(isset($_POST['mail'])){
                $mail=$_POST['mail'];
            }
            if(isset($_POST['password'])){
                $password= $_POST['password'];
                $passwordRenseigne= true;
            }
            if(isset($_POST['passwordConfirm'])){
                $passwordConfirm= $_POST['passwordConfirm'];
            }
            
            if($password==""||$password!=$passwordConfirm||$passwordRenseigne==false){
                $controller='vitrine';
                $pagetitle='S\'inscrire';
                $view='inscription';
                $mdpFalse=true;
            }else{
                $nonce = Security::generateRandomHex();
                $u= new ModelUtilisateur($id, $nom, $prenom, $date_naissance, $sexe, $pays, $adresse, $ville, $code_postal, $telephone, $mail, Security::chiffrer($password),0, $nonce);
                $switchVar = -1;
                
                if(filter_var($mail, FILTER_VALIDATE_EMAIL) != false){
                    $switchVar = $u->save();
                }
                
                switch($switchVar){
                    case 0:
                        $mailBienEnvoye = Mail::sendMailValidate($nonce, $mail);
                        if($mailBienEnvoye){
                            $controller='success';
                            $pagetitle='Utilisateur créé';
                            $view= 'accountCreated';
                        }else{
                            $controller='error';
                            $pagetitle='Contacter Administrateur';
                            $view='errorMail';
                        }
                        break;
                    case -2:
                        $controller='error';
                        $pagetitle='Déja un compte?';
                        $view='errorCreateAccount';
                        break;
                    case -1:
                        $controller='error';
                        $pagetitle='Contacter Administrateur';
                        $view='error';
                        break;
                }
            }
            require File::build_path(array('view','view.php'));
        }
        
        public static function seDeconnecter(){ //pas besoin de sécuriser ici
            Session::delete("user");
            $controller='vitrine';
            $pagetitle='Accueil';
            $view='accueil';
            require File::build_path(array('view','view.php'));
        }
        
        public static function read(){ //sécurisé
            
            if(Session::getObject('user')!=NULL){ //si l'utilisateur est connecté
                
                $user=Session::getObject("user");
                $controller='utilisateur';
                $pagetitle='Mon Profil';
                $view='profil';
                
            } else{ //si l'utilisateur n'est pas connecté
                $controller='error';
                $pagetitle='Veuillez vous connecter';
                $view='errorSessionClosed';
            }
            
            require File::build_path(array('view','view.php'));
        }
        
        public static function convertUserInAdmin(){ //sécurisé
            if(!isset($_GET["mail"])){
                ControllerError::errorPage();
                return false;
            }
            $mail= rawurldecode($_GET['mail']);
            
            
            if(Session::getObject('user')!=NULL){ //si l'utilisateur est connecté
                
                $userMail = ModelUtilisateur::select($mail);
                
                if($userMail != false){ //si le mail existe
                    if(Session::getObject('user')->isAdmin()){ //si l'user est un admin
                        $r=ModelUtilisateur::setAdminValue('1',$mail);
                        if($r){
                            $controller='success';
                            $pagetitle='Conversion Utilisateur en Administrateur';
                            $view='successConvertInAdmin';
                        }else{
                            $controller='error';
                            $pagetitle='Contacter Administrateur';
                            $view='error';
                        }
                    }else{ //si le user n est pas admin
                        $controller='error';
                        $pagetitle='Accès interdit';
                        $view='errorNoAccess';
                    }
                } else {//si le mail n'existe pas
                    $controller='error';
                    $pagetitle='Contacter administrateur';
                    $view="error";
                }
                
            } else{ //si l'utilisateur n'est pas connecté
                $controller='error';
                $pagetitle='Veuillez vous connecter';
                $view='errorSessionClosed';
            }
            
            require File::build_path(array('view','view.php'));
        }
        
        public static function convertAdminInUser(){ //sécurisé
            if(!isset($_GET["mail"])){
                ControllerError::errorPage();
                return false;
            }
            $mail= rawurldecode($_GET['mail']);
            
            if(Session::getObject('user')!=NULL){ //si l'utilisateur est connecté
                
                $userMail = ModelUtilisateur::select($mail);
                
                if($userMail != false){ //si le mail existe
                    if(Session::getObject('user')->isAdmin()){ //si l'user est un admin
                        $r=ModelUtilisateur::setAdminValue('0',$mail);
                        
                        if($r){
                            $controller='success';
                            $pagetitle='Conversion Utilisateur en Administrateur';
                            $view='successConvertInUser';
                        }else{
                            $controller='error';
                            $pagetitle='Contacter Administrateur';
                            $view='error';
                        }
                    }else{ //si le user n est pas admin
                        $controller='error';
                        $pagetitle='Accès interdit';
                        $view='errorNoAccess';
                    }
                } else {//si le mail n'existe pas
                    $controller='error';
                    $pagetitle='Contacter administrateur';
                    $view="error";
                }
                
            } else{ //si l'utilisateur n'est pas connecté
                $controller='error';
                $pagetitle='Veuillez vous connecter';
                $view='errorSessionClosed';
            }
            
            
            require File::build_path(array('view','view.php'));
        }
        
        public static function update(){ //sécurisé
            
            if(isset($_GET['mail'])){
                $user=ModelUtilisateur::select(rawurldecode($_GET['mail']));
            } else {
                $user=Session::getObject("user");
            }
            
            
            if(Session::getObject('user')!=NULL){ //si l'utilisateur est connecté
                
                $userMail = ModelUtilisateur::select($user->getMail_c());
                
                if($userMail != false){ //si le user existe
                    $mdpCorresp= true;
                    $nom = $user->getNom_c();
                    $prenom = $user->getPrenom_c();
                    $ville = $user->getVille_c();
                    $adresse = $user->getAdresse_c();
                    $tel = $user->getTelephone_c();
                    $cp = $user->getCode_postal_c();
                    $mail = $user->getMail_c();
                    $dateN = $user->getDate_naissance_c();
                    $controller='utilisateur';
                    $pagetitle='Modifier mon Profil';
                    $view='profileModif';
                } else {//si le user n'existe pas
                    $controller='error';
                    $pagetitle='Contacter administrateur';
                    $view="error";
                }
                
            } else{ //si l'utilisateur n'est pas connecté
                $controller='error';
                $pagetitle='Veuillez vous connecter';
                $view='errorSessionClosed';
            }
            
            
            
            require File::build_path(array('view','view.php'));
            
        }
        
        /*
         public static function accountDeleted(){
         $controller='success';
         $pagetitle='Modifier mon Profil';
         $view='accountUpdated';
         require File::build_path(array('view','view.php'));
         }
         */
        public static function updated(){ //sécurisé
            
            if(Session::getObject('user')!=NULL){ //si l'utilisateur est connecté
                
                $vueDefinie= false;
                $user_session = false;
                $array = array(
                               "nom_c" => $_POST["nom"],
                               "prenom_c" => $_POST["prenom"],
                               "code_postal_c" => $_POST["code_postal"],
                               "adresse_c" => $_POST["adresse"],
                               "ville_c" => $_POST["ville"],
                               "date_naissance_c" => $_POST["date_naissance"],
                               "mail_c" => $_POST["mail"],
                               "telephone_c" => $_POST["telephone"],
                               );
                $user = ModelUtilisateur::select($_POST["mail_c"]); //récupère l'ancien mail pour trouver l'utilisateur à mettre à jour
                
                if($user != false){ //si l'utilisateur a été trouvé
                    if(Session::getObject('user')->isAdmin() || Session::getObject('user')->getMail_c() == $_POST["mail_c"]){
                        if($_POST['mdp1']!="" && $_POST['mdp2']!=""){ //Si un mot de passe a été spécifié on test pour pouvoir le changer
                            
                            if($_POST['mdp1'] == $_POST['mdp2']){ //si les deux mots de passent se correspondent on peut ajouter le mot de passe aux champs à sauvegarder
                                $array['password_c'] = Security::chiffrer($_POST['mdp1']);
                                $vueDefinie = false;
                            } else { //si les deux mots de passe ne se correspondent pas
                                $nom= htmlspecialchars($_POST["nom"]);
                                $prenom = htmlspecialchars($_POST["prenom"]);
                                $cp = htmlspecialchars($_POST["code_postal"]);
                                $tel = htmlspecialchars($_POST["telephone"]);
                                $mail = htmlspecialchars($_POST["mail"]);
                                $adresse = htmlspecialchars($_POST["adresse"]);
                                $ville = htmlspecialchars($_POST["ville"]);
                                $dateN= htmlspecialchars($_POST["date_naissance"]);
                                $mdpCorresp= false;
                                
                                $controller='utilisateur';
                                $pagetitle='Modifier mon Profil';
                                $view='profileModif';
                                $vueDefinie = true;
                            }
                        } else { //Si aucun mot de passe n'as été spécifié on récupère celui de l'utilisateur
                            $array['password_c'] = $user->getPassword_c();
                        }
                    } else {
                        $controller='error';
                        $pagetitle='Accès interdit !';
                        $view='errorNoAccess';
                        $vueDefinie = true;
                    }
                    
                } else { //si l'utilisateur au mail donné n'as pas été trouvé
                    $controller='error';
                    $pagetitle='Contacter l\'administrateur';
                    $view='error';
                    $vueDefinie = true;
                }
                
                if(!$vueDefinie){ //on ne passe dans ce bloc que si tout s'esr bien passé et qu'on a définie la vue
                    if($user->update($array,$_POST["mail_c"])){ //Si la mise à jour à partir du mail a fonctionnée
                        
                        if(Session::getObject("user") != false){ //si l'utilisateur est connecté
                            if(Session::getObject("user")->getId_c()==$user->getId_c()){ //on verifie que ce soit son propre compte qu'on met à jour
                                if(Session::delete('user')){
                                    $user = ModelUtilisateur::select($_POST["mail"]);
                                    Session::setObject("user",$user); //pour mettre à jour se session
                                }else{
                                    $controller='error';
                                    $pagetitle='Contacter l\'administrateur';
                                    $view='error';
                                    $vueDefinie=true;
                                }
                            } 
                        } 
                        
                        if(!$vueDefinie){
                            $controller='success';
                            $pagetitle='Modifier mon Profil';
                            $view='accountUpdated';
                        }
                    } else { //si la mise à jour n'as pas fonctionnée
                        $controller='error';
                        $pagetitle='Contacter l\'administrateur';
                        $view='error';
                    }
                }
            } else{ //si l'utilisateur n'est pas connecté
                $controller='error';
                $pagetitle='Veuillez vous connecter';
                $view='errorSessionClosed';
            }
            
            require File::build_path(array('view','view.php'));
        } //fin de updated
        
        
        public static function seConnecter(){
            if($_POST['controller_go']==""){
                $controller_go="";
            }
            if($_POST['action_go']==""){
                $action_go="";
            }
            $users = ModelUtilisateur::selectAll();
            unset($errorMail);
            unset($errorMotDePasse);
            unset($isMail);
            unset($mdpTrue);
            unset($nonce);
            foreach($users as $val){ //on cherche si l'utilisateur au mail et mdp spécifiés existe
                $errorMailValidate=false;
                if($val->getMail_c() == $_POST["mail"]){
                    $isMail = true;
                    if($val->getPassword_c() == Security::chiffrer($_POST["mdp"])){ //et si le mot de passe est juste
                        $mdpTrue = true;
                    }
                    if($val->getNonce_c() != NULL){
                        $errorMailValidate = true;
                        $nonce = $val->getNonce_c();
                    }
                    break;
                }
            } 
            
            if(isset($isMail)){ //s'il y a un utilisateur avec ce mail
                
                if(isset($mdpTrue)){ //si l'utilisateur existe, et qu'il a tapé le bon mot de passe
                    if($errorMailValidate){ 
                        $user= ModelUtilisateur::select($_POST["mail"]);
                        $mail = $_POST["mail"];
                        $nonce= $user->getNonce_c();
                        $controller='error';
                        $pagetitle='Contacter administrateur';
                        $view='errorNoValidate';
                        require File::build_path(array('view','view.php'));  
                    } else {
                        $view = 'accueil';
                        $controller='vitrine';
                        $pagetitle='Connecté';
                        $user= ModelUtilisateur::select($_POST["mail"]);
                        if($user==false){
                            $controller='error';
                            $pagetitle='Contacter administrateur';
                            $view='error';
                            require File::build_path(array('view','view.php'));
                        }else{
                            Session::setObject('user',$user);
                            if($_POST['controller_go']!=""){
                                header("Location: index.php?controller=".$_POST['controller_go']."&action=".$_POST['action_go']);
                            }else{
                                require File::build_path(array('view','view.php'));  
                            }
                        }
                    }
                } else { //il a pas tapé le bon mot de passe
                    $errorMdp = true;
                    $view='connexion';
                    $controller='vitrine';
                    $pagetitle='connexion';
                    require File::build_path(array('view','view.php'));  
                }
            }
            else{ //le mail est inconnu
                $errorMail = true;
                $view='connexion';
                $controller='vitrine';
                $pagetitle='connexion';
                require File::build_path(array('view','view.php'));  
                
            }
            
        }
        
        
        public static function validate(){ //TODO : on pourrait sécuriser cette vue en passant un paramètre depuis la fonction appelante prouvant qu'elle n'a pas été appelé depuis l'url
            $nonce = $_GET["nonce"];
            $r=ModelUtilisateur::validate($nonce);
            if($r){
                $controller='success';
                $pagetitle='Validation du profil';
                $view='successValidate';
            }else{
                $controller='error';
                $pagetitle='Validation du profil';
                $view='error';
            }
            require File::build_path(array('view','view.php'));
        }
        
        public static function reSendMail(){
            $nonce= $_GET["nonce"];
            $mail= rawurldecode($_GET['mail']);
            Mail::sendMailValidate($nonce, $mail);
        }
        
        public static function readCommandes(){//sécurisé
            
            if(Session::getObject('user')!=NULL){ //si l'utilisateur est connecté
                
                $id_c = Session::getObject('user')->getId_c();
                $commandes = ModelCommande::getCommandes($id_c);
                $controller='commande';
                $pagetitle='Liste des commandes';
                $view='list';
                
            } else{ //si l'utilisateur n'est pas connecté
                $controller='error';
                $pagetitle='Veuillez vous connecter';
                $view='errorSessionClosed';
            }
            
            require File::build_path(array('view','view.php'));
        }
        
    }
    
    
    
    
    ?>

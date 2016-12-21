<?php
    class Mail{
        //cette fonction étant accessible deuis l'url, son fonctionnement est protégé : il faut activer les mail avant utilisation
        public static function sendMailValidate($nonce = NULL, $mail = NULL){
            if($nonce != NULL){
                $message = '<!DOCTYPE HTML>
                <head>
                <meta charset="UTF-8">
                </head>
                <p>Pour confirmer votre compte :</p>
                <p><a href="http://infolimon.iutmontp.univ-montp2.fr/~tartierem/eCommerce/index.php?controller=utilisateur&action=validate&nonce='. $nonce.'">Cliquez ici pour activer votre compte</a></p>
                <p>Si vous n\'avez pas fait de création de compte, veuillez simplement ignorer ce mail.</p>
                <p>Cordialement l\'equipe Evobrain</p>';
                
                // In case any of our lines are larger than 70 characters, we should use wordwrap()
                $message = wordwrap($message, 70, "\r\n");
                
                // Send
                //    echo $mail;
                echo $message;
                $r = mail($mail, 'Validation inscription !', $message);
                return $r;
            }
            else{
                return false;
            }
        }
        
        public static function send($nom=NULL,$prenom=NULL,$mail=NULL,$cp=NULL,$date=NULL,$pays=NULL,$entendu=NULL,$objet=NULL,$message=NULL){
            
            if($mail != NULL){
                $message = '<!DOCTYPE HTML>
                <head>
                <meta charset="UTF-8">
                </head>
                <p>Mail de contact envoyé depuis le site :</p>
            <p>Nom: '.$nom.'</p>
            <p>Prenom: '.$prenom.'</p>
            <p>Mail: '.$date.'</p>
                <p>Code Postal: '.$cp.'</p>
                <p>Date de re-contact possible: '.$date.'</p>
            <p>Pays: '.$cp.'</p>
                <p>A entendu parler par: '.$entendu.'</p>
            <p>Objet:'.$objet.'</p>
            <p>Message: '.$message.'</p>
                ';
                
                // In case any of our lines are larger than 2000 characters, we should use wordwrap()
                $message = wordwrap($message, 2000, "\r\n");
                $mail_contact= 'evobrain_admin@yopmail.com';
                $r = mail($mail_contact, 'Contact depuis le site Evobrain !', $message);
                return $r;
            }
            else{
                return false;
            }
        }
    }
    
    ?>

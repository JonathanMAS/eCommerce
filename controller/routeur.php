<?php
    require_once File::build_path(array('controller','ControllerProduit.php'));
    require_once File::build_path(array('controller','ControllerPrincipal.php'));
    require_once File::build_path(array('controller','ControllerPanier.php'));
    require_once File::build_path(array('controller','ControllerUtilisateur.php'));
    require_once File::build_path(array('controller','ControllerCommande.php'));
    require_once File::build_path(array('controller','ControllerError.php'));
    
    
    
    if(isset($_GET['action'])){
        $action = $_GET['action'];    // recupère l'action passée dans l'URL
    }else{
        $action="accueil";
    }
    if(isset($_GET['controller'])){
        $controller = $_GET['controller'];    // recupère l'action passée dans l'URL
    }else{
        $controller="principal";
    }
    
    
    $controller_class = "Controller".ucfirst($controller);
    
    
    if(!class_exists($controller_class)){
        $controller_class="ControllerPrincipal";
        $action="error";
    }
    
    if(!in_array($action,get_class_methods($controller_class))){
        $controller_class="ControllerPrincipal";
        $action="error";
    }
    
    ControllerPanier::creationPanier();
    
    $controller_class::$action();
    
    
    
    ?>

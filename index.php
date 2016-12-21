<?php
    $DS = DIRECTORY_SEPARATOR;
    require_once 'lib'.$DS.'File.php';
    require_once File::build_path(array("lib","Session.php"));
    require_once File::build_path(array("lib","Cookie.php"));
    Session::initSession();
    require_once File::build_path(array("controller","routeur.php"));
    
    ?>

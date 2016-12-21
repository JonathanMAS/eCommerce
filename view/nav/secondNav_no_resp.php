<nav class="second-nav">
    
    <div><a href="index.php?controller=principal&action=presentationEquipe">Equipe</a></div>
    <div><a href="index.php?controller=principal&action=contact">Contact</a></div>
    <div><a href="index.php?controller=principal&action=nousRejoindre">Nous Rejoindre</a></div>
    <div class="social" >
        <a	href="index.php?controller=panier&action=readAll"><img title="Accéder à votre panier" src="<?php echo File::build_HTMLpath(array("style", "img", "panier.png"))?>" width="25" height="25" alt="panier header"></a>
        <a  href="index.php?controller=principal&action=connexion"><img title="Accéder à votre compte" src="<?php echo File::build_HTMLpath(array("style", "img", "log" . (Session::getObject("user")!=NULL ? "ged":"in").".png"))?>" width="25" height="25" alt="login header"></a>
        <a  href="http://www.facebook.com/"><img title="Suivez nous sur facebook" src="<?php echo File::build_HTMLpath(array("style", "img", "facebook-header.png"))?>" width="25" height="25" alt="facebook header"></a>
        <a  href="https://twitter.com/"><img title="Suivez nous sur tweeter" src="<?php echo File::build_HTMLpath(array("style", "img", "twitter-header.png"))?>" width="25" height="25" alt="twitter header"></a>
    </div>
</nav>


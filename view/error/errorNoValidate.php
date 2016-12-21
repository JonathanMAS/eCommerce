<main class="error_success">
    <div id="banner_error_success" class="banner">
        <div class="banner-text-error-success">
            <h3>ERREUR DE CONNEXION!</h3>
        </div>
    </div>
    <div>
        <div class="error_bloc_account">
            <h3>Compte non validé!</h3>
            <p>Votre compte n'est pas validé. Veuillez l'activer en suivant le lien envoyé par mail.</p>
            <p>Si jamais vous n'avez pas reçu de mail, vérifiez dans vos spam ou cliquez sur le bouton pour en renvoyer un :
            <a class="button" href="index.php?controller=utilisateur&action=reSendMail&nonce=<?php echo $nonce?>&mail=<?php echo rawurlencode($mail)?>">Envoyer un mail</a>
            </p>
        </div>
        <div class="bloc_button">
            <a href="index.php?action=connexion" class="button_bis">Se Connecter</a>
            <a href="index.php" class="button_bis">Retour à l'Accueil</a>
        </div>
    </div>
    
</main>

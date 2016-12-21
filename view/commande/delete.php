<main class="error_success">
    <div id="banner_error_success" class="banner">
        <div class="banner-text-error-success">
            <h3>Suppression de la commande !</h3>
        </div>
    </div>
    <div>
        <div class="error_bloc_account">
            <h3>Suppression de la commande</h3>
            <p>Etes vous sur de vouloir supprimer cette commande ? Cette action sera définitive!</p>
        </div>
        <div class="bloc_button">
            <a href="index.php?controller=commande&action=readAll" class="button_bis">Retour</a>
            <a href="index.php?controller=commande&action=deleted&id=<?php echo $id?>" class="button_bis_red">Supprimer</a>
        </div>
    </div>
    
</main>

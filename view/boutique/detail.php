
<main>
    <div class="banner">
        <img src="<?php echo File::build_HTMLpath(array("style", "img", "boutique", "produits",$img_p))?>" alt="" class="img-presentation"/>
        <div class="banner-text" id="banner-text-product">
            <h2><?php echo $prix_p."€"?></h2>
            <p><?php echo $nom_p?></p>
        </div>
    </div>
    
    <div class="bloc detail">
        <div class="text">
            <h2><?php echo $descr_p?></h2>
            <h3>Description</h3>
            <p><?php echo $descr_d_p?></p>
        </div>
        <div class=\"bottom-detail-text\"/>
        <a href="index.php?controller=panier&action=ajouterAuPanier&product=<?php echo $id_p;?>&qte=1" class="button_bis">Ajouter au Panier</a>
    </div>
    </div>
</main>



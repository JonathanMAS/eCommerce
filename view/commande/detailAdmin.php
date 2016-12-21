
<main>
    <div id="banner_joinus" class="banner">
        <div class="banner-text">
            <h3>Commande R<?=$id_command?>!</h3>
            <p id="science">Edition de la commande R<?=$id_command?></p>
        </div>
    </div>
    
    <?php
        
        
        echo '<div class="bloc">
        <div class="text-panier">
        <div class="article">
        <h3>Article</h3>
        </div>
        
        <div class="quantite_prix">
        <h3 class="prix_u">Prix unitaire</h3>
        <h3 class="qte">Qté</h3>
        <h3 class="prix_t">Prix Total</h3>
        </div>
        
        </div>
        </div>';
        $montant = 0;
        
        
        foreach($produits as $produit){ //pour chaque article sous l'alias d'id
            $qteProduit= ModelCommande::selectNbProduit($commande->getId(), $produit->getId_p()); //
            $prix_total_produit = $qteProduit*($produit->getPrix_p());
            $montant += $prix_total_produit;
            echo'
            <div class="bloc">
            <div class="text-panier">
            <div class="article">
            <h3>'.$produit->getNom_p().'</h3>
            </div>
            <div class="quantite_prix">
            <h3 class="prix_u">'.$produit->getPrix_p().'€ </h3>
            <div>
            <a href="index.php?controller=commande&action=modifierQteDansCommande&produit='.$produit->getId_p().'&qte='.($qteProduit+1).'&command='.$id_command.'" class="button_bis_green">+</a>
            <h3 class="qte">'.$qteProduit.'</h3>
            <a href="index.php?controller=commande&action=modifierQteDansCommande&produit='.$produit->getId_p().'&qte='.($qteProduit-1).'&command='.$id_command.'" class="button_bis_red">-</a>
            </div>
            <h3 class="prix_t">'.$prix_total_produit.'€ </h3>
            </div>
            </div>
            </div>';
        }
    
    
    
    echo'
    <div class="bloc_panier bloc">
    <div id="bouton_remonter">
    <a class="button_bis" href="#banner_joinus">Remonter la page</a>
    </div>
    ';
    
    echo '
    </div>';
    
    
    
        ?>
    
</main>


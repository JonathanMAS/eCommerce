
<main>
    <div id="banner_joinus" class="banner">
        <div class="banner-text">
            <h3>Mon Panier</h3>
            <p id="science">Consulter les articles dans votre panier</p>
        </div>
    </div>
    
    <?php
        if($nbProduitPanier!=0){
            
            echo '<div class="bloc">
            <div class="text-panier">
            <div class="article">
            <h3>Article</h3>
            </div>
            
            <div class="quantite_prix">
            <h3 class="prix_u">Prix unitaire</h3>
            <h3 class="qte">Qté</h3>
            <h3 class="prix_t">Prix Total</h3>
            <h3 class="suppr">Supprimer</h3>
            
            </div>
            
            </div>
            </div>';
            
            foreach($panier['Produit'] as $id){
                $produit = ModelProduit::select($id);
                $qteProduit= ModelPanier::qteProduit($id);
                echo'
                <div class="bloc">
                <div class="text-panier">
                <div class="article">
                <h3>'.$produit->getNom_p().'</h3>
                </div>
                <div class="quantite_prix">
                <h3 class="prix_u">'.$produit->getPrix_p().'€ </h3>
                <div >
                <a href="index.php?controller=panier&action=modifierQteDansPanier&product='.$produit->getId_p().'&qte='.($qteProduit+1).'" class="button_bis_green">+</a>
                <h3 class="qte">'.$qteProduit.'</h3>
                <a href="index.php?controller=panier&action=modifierQteDansPanier&product='.$produit->getId_p().'&qte='.($qteProduit-1).'" class="button_bis_red">-</a>
                </div>
                <h3 class="prix_t">'.$qteProduit*($produit->getPrix_p()).'€ </h3>
                <h3 class="suppr"><a href="index.php?controller=panier&action=suppDuPanier&product='.$produit->getId_p().'">X</a></h3>
                </div>
                </div>
                </div>';
            }
            
            echo'
            <div class="bloc">
            <div class="text-total-panier"></div>
            <div class="text-total-panier">
            <div>
            <h3 id="label_panier">Nombre d\'article dans le panier:</h3><h3 id="value">'.$nbProduitPanier.'</h3>
            </div>
            <div>
            <h3 id="label_panier">Prix Total:</h3><h3 id="value" >'.$montant.'€</h3>
            </div>
            </div>
            </div>';
            
            echo'
            <div class="bloc_panier bloc">
            <div>
            <a class="button_bis" href="index.php?controller=produit&action=readAll">Retour à la boutique</a>
            </div>
            <div>
            <a class="button_bis" href="index.php?controller=panier&action=viderPanier">Vider le panier</a>
            </div>
            <div>
            <a class="button_bis" href="index.php?controller=panier&action=save">Passer commande</a>
            </div>
            </div>';
            
        }else{
            echo '
            <div class="bloc_panier">
            <div class="text">
            <h3>Le panier est vide</h3>
            <div>
            <a class="button_bis" href="index.php?controller=produit&action=readAll">Aller à la boutique</a>
            </div>
            </div>
            </div>
            ';
        }
    ?>
    
</main>


<main>
    <div id="banner_joinus" class="banner">
        <div class="banner-text">
            <h3>Boutique</h3>
            <p id="science">Acheter les accessoires ou les Mind Storage Glasses</p>
            <?php
                if($admin){
                    echo    '<h2><a class="button_bis" href="index.php?controller=produit&action=update">Ajouter produit</a></h2>';
                }
            ?>
        </div>
    </div>
    
    <?php
        foreach ($tab_p as $p){
            $id_p = $p->getId_p();
            $nom_p = htmlspecialchars($p->getNom_p());
            $prix_p = htmlspecialchars($p->getPrix_p());
            $descr_p = htmlspecialchars($p->getDescription_p());
            $img_p = htmlspecialchars($p->getImage_p());
            
            echo "<div class=\"bloc\"><img src=\"style/img/boutique/produits/";
            echo $img_p;
            echo "\" alt=\"\" class=\"img-text\"/><div class=\"text\"><h3>";
            echo $nom_p;
            echo "</h3><p>";
            echo $descr_p;
            echo "</p>";
            echo "<p><a href=\"index.php?controller=produit&action=read&product=".$id_p."\">Plus de détails...</a></p>";
            if($admin){
                
                echo "<p><a class=\"button_bis\" href=\"index.php?controller=produit&action=update&product=".$id_p."\">Editer</a>
                <a class=\"button_bis_red\" href=\"index.php?controller=produit&action=delete&product=".$id_p."\">Supprimer</a></p>";
            }
            echo "</div><div class=\"right-boutique-text\"><h3>";
            echo $prix_p."€";
            echo "</h3>";
            echo "<a href=\"index.php?controller=panier&action=ajouterAuPanier&product=".$id_p."&qte=1\" class=\"button\">Ajouter au Panier</a></div></div>";
            
        }
    ?>
    
</main>




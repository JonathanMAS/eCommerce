<main>
    <div id="banner_joinus" class="banner">
        <div class="banner-text">
            <h3>Liste des commandes</h3>
            <p id="science">Gérer les commandes</p>
        </div>
    </div>
    
    <?php
        
        $nbCommande = 1;
        $nbCommandeTotal = count($commandes);
        foreach ($commandes as $c){
            $id_c = htmlspecialchars($c->getId());
            $idClient_c = htmlspecialchars($c->getIdClient());
            $dateCommande_c = htmlspecialchars($c->getDateCommande());
            
            $user = ModelUtilisateur::selectBy("id_c", $c->getIdClient());
            $nom = $user == false ? "???" : $user->getNom_c();
            $prenom = $user == false ? "???" : $user->getPrenom_c();
            $mail =$user == false ? "???" :  $user->getMail_c();
            
            
            echo "<div class=\"bloc\">";
            echo "<div class=\"text\">";
            
            echo "<h3>Commande numéro ";
            echo $nbCommande . "/" . $nbCommandeTotal;
            
            echo "</h3>";
            
            echo "<p>";
            echo "Référence :  <span class=\"colorA\">" . $id_c . "</span> ";
            
            echo "ID Client : <span class=\"colorA\">" . $idClient_c . "</span> ";
            
            echo "Date : <span class=\"colorA\">" . $dateCommande_c ."</span> ";
            echo "</p>";
            
            echo "<p>";
            echo "Nom :  <span class=\"colorA\">" . $nom . "</span> ";
            
            echo "Prenom : <span class=\"colorA\">" . $prenom . "</span> ";
            
            echo "Mail : <span class=\"colorA\">" . $mail ."</span> ";
            
            echo "</p>";
            
            
            
            echo "<p>";
            if(Session::getObject('user')->isAdmin()){
                echo "<a class=\"button_bis\" href=\"index.php?controller=commande&action=read&commande=".$id_c."\">Consulter / Editer</a>
                <a class=\"button_bis_red\" href=\"index.php?controller=commande&action=delete&commande=".$id_c."\">Supprimer</a>";
                echo "</p>";
            }else{
                echo "<a class=\"button_bis\" href=\"index.php?controller=commande&action=read&commande=".$id_c."\">Consulter</a>";
            }
            
            echo "</div></div>";
            $nbCommande++;
        }
    if($nbCommandeTotal>0){
        echo "<p><a class=\"button_bis\" href=\"#banner_joinus\">Haut de la page</a><p>";
    }else{
        echo '
        <div class="bloc_panier">
        <div class="text">
        <h3>Vous n\avez pas encore de commande</h3>
        <div>
        <a class="button_bis" href="index.php?controller=produit&action=readAll">Aller à la boutique</a>
        </div>
        </div>
        </div>
        ';
    }
    ?>
    
</main>




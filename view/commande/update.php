<main id="mainEditeProduit">
    
    <div id="lienRetour">
        <a href="index.php?controller=commande&action=readAll"> << Retour </a>
            </div>
    
    <form method="post" action="index.php?controller=produit&action=updated">
        <div>
            <h3><?php echo $formTitle ?> une commande</h3>
            <input type="hidden" name="action_bis" value="<?=$hiddenValue?>">
                <input type="hidden" name="id" value="<?=$id?>" required/>
                
                
                <p>
                <label for="nomP">Nom: </label>
                <input type="text" name="nom" id="nom" value="<?=$nom?>" required/>
                </p>
                <p>
                <label for="desc">Description courte: </label>
                <input type="text" name="desc" id="desc" value="<?=$desc?>" required/>
                </p>
                
                <p>
                <label for="prix">Prix: </label>
                <input type="text" name="prix" id="prix" value="<?=$prix?>" required/>
                </p>
                
                <p>
                <label for="img">Nom du fichier image associé: </label>
                <input type="text" name="img" id="img" value="<?=$img?>" required/>
                </p>
                
                <p>
                <label for="descD">Description détaillée: </label>
                <textarea name="descD" id="descD"  cols="20" rows="4" required><?=$descD?></textarea>
                </p>
                
                </div>
        
        
        <p>
        <input class="button_bis" type="submit" value="Envoyer" />
        </p>
        
        
    </form>
    
    
    
    
</main>

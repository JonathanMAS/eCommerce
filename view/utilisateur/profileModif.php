<script type="text/javascript" src="script/inscription.js"></script>

<main id="mainProfilModif">
    
    <div id="lienRetour">
        <a href="index.php?controller=utilisateur&action=read"> << Retour </a>
            </div>
    
    <h3>Modification de votre profil</h3>
    <?php
        if(!$mdpCorresp){
            echo '<p style="color:red;">Erreur de Mot de passe</p>';
        }
    ?>
    <form id="modificationProfil" action="index.php?controller=utilisateur&action=updated" method="post">
        <div class="bloc">
            <div id="bloc_gauche">
                <div>
                    <label for="nom">Nom: </label>
                    <input id="nom" name="nom" type="text" value="<?php echo $nom ?>"  required>
                        </div>
                
                <div>
                    <label for="prenom">Prénom: </label>
                    <input id="prenom" name="prenom" type="text" value="<?php echo $prenom ?>" required>
                        </div>
                
                <div>
                    <label for="date">Date de naissance: </label>
                    <input id="dateN" name="date_naissance" type="date" value="<?php echo $dateN ?>" required>
                        </div>
                
                <div>
                    <label for="Tel">Téléphone: </label>
                    <input id="tel" name="telephone" type="text" value="<?php echo "0".$tel ?>" required>
                        </div>
                
                <div>
                    <label for="mail">Email: </label>
                    <input type="mail" id="mail" name="mail" value="<?php echo $mail ?>" required>
                        <input type="hidden" name="mail_c" value="<?php echo $mail ?>">
                            </div>
            </div> <!--fin bloc gauche-->
            <div id="bloc_droit">
                <div>
                    <label for="Ad">Adresse: </label>
                    <input id="ad" name="adresse" type="text" value="<?php echo $adresse ?>" required>
                        </div>
                
                <div>
                    <label for="city">Ville: </label>
                    <input id="city" name="ville" type="text" value="<?php echo $ville ?>" required>
                        </div>
                
                <div>
                    <label for="CP">Code postal: </label>
                    <input id="CP" name="code_postal" type="number" value="<?php echo $cp ?>" required>
                        </div>
                
                <div>
                    <label for="mdp_id">Mot de Passe :</label>
                    <input oninput="checkInputMdp()" id="mdp" name="mdp1" type="password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="Le mot de passe doit contenir au moins un chiffre, une majuscule et une minuscule. Le nb de caractères ne doit pas
                        être inférieur à 8.">
                        </div>
                <div>
                    <label id="mdp_id2" for="mdp">Confirmation :</label>
                    <input oninput="checkInputMdp()" id="mdp_c" name="mdp2" type="password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}">
                        
                        </div>
            </div> <!--fin bloc droit-->
        </div>
        
        <div id="bloc_validation">
            <input  class="button_bis" type="submit" value="Valider" onclick="checkPass()">
                </div>
        
    </form>
</main>


<script type="text/javascript" src="script/inscription.js"></script>

<main>
    <div id="banner_form" class="banner">
        <div class="banner-text">
            <h3>Formulaire d'inscription</h3>
            <p>Entrez dans l'univers EvoBrain</p>
        </div>
    </div>
    <form id="form_inscription" action="index.php?controller=utilisateur&action=created" method="post">
        <div id="bloc_form1">
            <div class="text_form">
                <?php
                    if($mdpFalse){
                        echo '<p style="color:red;">Erreur de Mot de passe</p>';
                    }
                ?>
                <h3>Identifiants de connexion</h3>
                <br>
                <div>
                    <label for="email">Email:</label><span>*</span>
                    <input type="email" id="mail" name="mail" value="<?=$mail?>" placeholder="yourmail@domain.com"  required>
                        </div>
                <div>
                    <label id="mdp_id" for="mdp">Mot de Passe: </label><span>*</span>
                    <input oninput="checkInputMdp()" id="mdp" name="password" type="password" required pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="Doit contenir au moins un chiffre, une majuscule et une minuscule. Ne pas être inférieur à 8.">
                        </div>
                <div>
                    <label id="mdp_id2" for="mdp_c">Confirmer le mot de passe: </label><span>*</span>
                    <input oninput="checkInputMdp()" id="mdp_c" name="passwordConfirm" type="password" required pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="Doit contenir au moins un chiffre, une majuscule et une minuscule. Ne pas être inférieur à 8.">
                        </div>
            </div>
        </div>
        <div id="bloc_form2">
            <div class="text_form">
                <h3>Informations personnelles</h3>
                <br>
                <div>
                    <label for="nom">Nom: *</label>
                    <input id="nom" name="nom" type="text" value="<?=$nom?>" required>
                        </div>
                <div>
                    <label for="prenom">Prénom: *</label>
                    <input id="prenom" name="prenom" type="text" value="<?=$prenom?>" required>
                        </div>
                
                <div>
                    <label for="date">Date de naissance: *</label>
                    <input id="date" name="date_naissance" type="date" value="<?=$date_naissance?>" required>
                        </div>
                
                
                
                <div>
                    <label>Sexe: </label><br>
                    <input class="Sexe" value="M" name="sexe" type="radio" required>Masculin<br>
                        <input class="Sexe" value="F" name="sexe" type="radio">Feminin<br>
                            </div>
                
                
            </div>
        </div>
        <div id="bloc_form3">
            <div class="text_form">
                <h3>Informations complémentaires</h3>
                <br>
                <div>
                    <label for="pays">Pays d'origine: </label>
                    <span>*</span>
                    <select id="pays" name="pays">
                        <option value="Algerie">Algerie</option>
                        <option value="Allemagne">Allemagne</option>
                        <option value="Belgique">Belgique</option>
                        <option value="Chili">Chili</option>
                        <option value="Chine">Chine</option>
                        <option value="Congo">Congo</option>
                        <option value="Espagne">Espagne</option>
                        <option value="USA">Etats-Unis</option>
                        <option value="France" selected>France</option>
                        <option value="Grande Bretagne">Grande-Bretagne</option>
                        <option value="Grece">Grèce</option>
                        <option value="Italie">Italie</option>
                        <option value="Japon">Japon</option>
                        <option value="Maroc">Maroc</option>
                        <option value="Suisse">Suisse</option>
                    </select>
                </div>
                
                <div>
                    <label for="Ad">Adresse</label>
                    <span>*</span>
                    <input id="Ad" name="adresse" type="text" value="<?=$adresse?>" required>
                        </div>
                
                <div>
                    <label for="city">Ville</label>
                    <span>*</span>
                    <input id="city" name="ville" type="text" value="<?=$ville?>" required>
                        </div>
                
                <div>
                    <label for="CP">Code postal</label>
                    <span>*</span>
                    <input id="CP" name="code_postal" type="number" value="<?=$code_postal?>" min="0" max="99999" required>
                        </div>
                
                <div>
                    <label for="Tel">Telephone</label>
                    <span class="Noblige">*</span>
                    <input id="Tel" name="telephone" type="number" value="<?=$telephone?>" min="0" max="9999999999" >
                        </div>
                <br>
                
                <div id="license_div">
                    <input id="licenseheck" type="checkbox" name="clause" value="clause" required>
                        <span>*</span>
                        <label id="license" for="licenseheck"> J'ai lu et j'accepte les termes et conditions d'utilisation</label>
                        </div>
                
                
                <p id="annexe">
                <span>*</span>Champs obligatoires
                </p>
                <input type='hidden' name='controller' value='utilisateur'>
                    <input type='hidden' name='action' value='created'>
                        <div id="inscrire">
                            <input  type="submit" value="Envoyer" onclick="checkPass()">
                                </div>
                        </div>
        </div>
    </form>
</main>


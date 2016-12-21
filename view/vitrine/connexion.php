<main>
    <div id="banner_connect" class="banner">
        <div class="banner-text">
            <h3>Se Connecter</h3>
            <p>Déjà dans l'univers EvoBrain?</p>
        </div>
    </div>
    <div id="div_connect">
        <div id="bloc_connect1">
            <div id="div_label" class="text_connect text_form">
                <h3>Se connecter</h3>
                <?php
                    if($controller_go!=null){
                    ?>
                
                <div style="color:red">Merci de vous connecter avant d'accéder à cette page!</div>
                
                <?php
                    }
                    ?>
                
                <?php
                    if(isset($errorMail)){
                    ?>
                
                <div style="color:red">Mail incorrect !</div>
                
                <?php
                    }
                    ?>
                <?php
                    if(isset($errorMdp)){
                    ?>
                
                <div style="color:red">Mot de passe incorrect</div>
                
                <?php
                    }
                    ?>
                
                
                
                <form action="index.php?controller=utilisateur&action=seConnecter" method="post">
                    <input name="controller_go" type="hidden" value="<?=$controller_go?>">
                        <input name="action_go" type="hidden" value="<?=$action_go?>">
                            <div>
                                <label for="mail">Email:</label><span>*</span>
                                <input id="mail" name="mail" type="email" placeholder="yourmail@domain.com" required>
                                    </div>
                            <div>
                                <label for="mdp">Mot de Passe: </label><span>*</span>
                                <input id="mdp" name="mdp" type="password" required pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{7,}"
                                    title="Doit contenir au moins un chiffre, une majuscule et une minuscule. Ne pas être inférieur à 7.">
                                    </div>
                            <div class="button_connect">
                                <input  type="submit" value="ENVOYER">
                                    </div>
                            </form>
            </div>
        </div>
        <div id="bloc_connect2">
            <div class="text_connect text_form">
                <h3>S'inscrire</h3>
                <div>
                    <p> Pas encore inscrit?<br>Cliquez sur le bouton s'incrire pour vous inscrire!</p>
                </div>
                
                <div class="button_inscr">
                    <a href="index.php?controller=utilisateur&action=create" >S'inscrire</a>
                </div>
                
            </div>
        </div>
    </div>
</main>


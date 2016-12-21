<main>
    <div id="banner_joinus" class="banner">
        <div class="banner-text administration">
            <h3>Gestion des utilisateurs</h3>
        </div>
    </div>
    <?php
        $i=1;
        foreach($users as $user){
            if($user->getId_c()!=$id){
                if($i%2==0){
                    $icone= 'login_E7';
                }else{
                    $icone= 'login';
                }
                $i++;
                echo'<div class="bloc">
                <img src="style/img/'.$icone.'.png" alt="" class="img-text"/>
                <div class="text">
                <h3>'. $user->getNom_c().' '.$user->getPrenom_c().'</h3>
                </div>
                <div class="right-ListUser-text"/>';
                
                if($user->isAdmin()){
                    echo '<a href="index.php?controller=utilisateur&action=convertAdminInUser&mail='.rawurlencode($user->getMail_c()).'" class="button_bis">Convertir en Utilisateur</a>';
                }else{
                    echo '<a href="index.php?controller=utilisateur&action=convertUserInAdmin&mail='.rawurlencode($user->getMail_c()).'" class="button_bis_red">Convertir en Administrateur</a>';
                }
                
                echo '<a href="index.php?controller=utilisateur&action=update&mail='.rawurlencode($user->getMail_c()).'" class="button_bis">Editer</a>
                <a href="index.php?controller=utilisateur&action=delete&mail='.rawurlencode($user->getMail_c()).'" class="button_bis_red">Supprimer</a>';
                
                if($user->getNonce_c()==NULL){
                    echo '<a href="" class="button_bis_grey">Valider</a>';
                }else{
                    echo '<a href="index.php?controller=utilisateur&action=validate_Manu&id='.$user->getMail_c().'" class="button_bis">Valider</a>';
                }
                
                echo'</div>
                </div>';
            }
        }

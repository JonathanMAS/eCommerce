<main id="mainProfil">
  
    <div class="bloc"> 
        <div id="div1">
          		<div>
            		<img src="style/img/login_E7.png" id="photoProfile" alt="" class="img-text"/>
          		</div>
          		<div id="sousdiv1">
            		</br>
            		<h3> <?php echo $user->getPrenom_c()." ".$user->getNom_c(); ?> </h3>
            		<p> <?php echo $user->getDate_naissance_c(); ?> </p>
              	</div>
      	</div>
      	
      	<div class="cadre" >
        		<div> <p class="mot">ADRESSE</p> <p class="infos"> <?php echo $user->getAdresse_c(); ?> </p> </div>
        	    <div> <p class="mot">VILLE</p> <p class="infos"> <?php echo $user->getVille_c(); ?></p> </div>
        	    <div> <p class="mot">CODE POSTAL</p> <p class="infos"> <?php echo $user->getCode_postal_c(); ?></p> </div>
      	</div>
      
      	<div class="cadre" >
          		<div><p class="mot">MAIL</p> <p class="infos"> <?php echo $user->getMail_c(); ?></p> </div>
          		<div><p class="mot">TELEPHONE</p> <p class="infos"> 
          		<?php 
          		if($user->getTelephone_c()=="0"){
          		    echo "0".$user->getTelephone_c();
          		}else{
          	    	echo "N.C";
          		}
          		?></p> </div>
      	</div>
      	
      	<div class="button_inscr">
              <a href="index.php?controller=utilisateur&action=update">Modifier le profil</a>
        </div>
      
    </div> 

</main>
<?php
    if(isset($_POST['email_contact'])){
    ?>
</br>
<h1>Nous vous répondrons dans les plus bref délais à l'adresse </h1>
<?php
    echo $_POST['email_contact'];
    } else {
    ?>

<main>
    <div id="banner_contact" class="banner">
        <div class="banner-text">
            <h3>Contactez Nous</h3>
            <h1>Comment nous contacter?</h1>
            <p>Pour cela merci de remplir ce formulaire ci-dessous</p>
        </div>
    </div>
    <div id="formulaire_contact">
        
        <form action="index.php?controller=principal&action=contacted" method="post">
            
            <h3>Remplissez  ce formulaire</h3>
            
            
            <div>
                <label for="nom_contact">Nom :</label>
                <span>*</span>
                <input type="text" name="nom" id="nom_contact" placeholder="e.g.: Dupont" required/>
            </div>
            
            <div>
                <label for="prenom_contact">Prénom :</label>
                <span>*</span>
                <input type="text" name="prenom" id="prenom_contact" placeholder="e.g. Jacques" required/>
            </div>
            
            <div>
                <label for="email_contact">Adresse email :</label>
                <span>*</span>
                <input type="email" name="mail" id="email_contact" placeholder="e.g. yourmail@domain.com" required/>
            </div>
            
            <div>
                <label for="codep_contact">Code postale :</label>
                <span>*</span>
                <input type="number" name="cp" min="000001" max="999999" size="6" id="codep_contact" placeholder="e.g. 34000" required/>
            </div>
            
            <div>
                <label for="date_when">Quand pouvons-nous vous recontacter? </label>
                <span class="Noblige">*</span>
                <input type="date" name="date" id="date_when" />
            </div>
            
            <div id="select">
                
                <label for="pays_contact">Dans quel pays habitez-vous ?</label>
                <span>*</span>
                <select name="pays" id="pays_contact">
                    
                    <optgroup label="Europe">
                        
                        <option value="france">France</option>
                        
                        <option value="espagne">Espagne</option>
                        
                        <option value="italie">Italie</option>
                        
                        <option value="royaume-uni">Royaume-Uni</option>
                        
                    </optgroup>
                    
                    <optgroup label="Amérique">
                        
                        <option value="canada">Canada</option>
                        
                        <option value="etats-unis">Etats-Unis</option>
                        
                    </optgroup>
                    
                    <optgroup label="Asie">
                        
                        <option value="chine">Chine</option>
                        
                        <option value="japon">Japon</option>
                        
                    </optgroup>
                </select>
            </div>
            
            <br>
            
            <div>
                <p>
                Comment avez-vous entendu parler de nous?<br/>
                <p>
                
                <label for="connaissance">Par une connaissance</label>
                <input id="connaissance" type="radio" name="entendu" value="connaissance"/> <br>
                <label for="article">Dans un article</label>
                <input id="article" type="radio" name="entendu" value="article" /> <br>
            </div>
            
            <div>
                <label for="objet_contact">Objet :</label>
                <span>*</span>
                <input type="text" name="objet" id="objet_contact" placeholder="e.g. Problème avec mon produit" required/>
            </div>
            
            <div>
                <label for="message_contact">Message :</label>
                <span class="Noblige">*</span>
                <textarea id="message_contact" name="message" placeholder="Mon texte ici..."></textarea>
            </div>
            
            
            <div>
                <button type="submit">Envoyer votre message</button>
            </div>
            
        </form>
    </div>
    
</main>


<?php
    }
    ?>

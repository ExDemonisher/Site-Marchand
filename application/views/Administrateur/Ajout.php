<html>
    <body>
        <?php echo validation_errors();
        echo form_open('Administrateur/Ajout');

        // if((!is_null($this->session->profil)) and ($this->session->profil == "Administrateur")):
        //     // Redirect vers Partie Admin
        //     $this->load->view("Administrateur/Ajout");
            
        // else:
        //     // Redirect vers Acceuil
        //     redirect('Visiteur/PageDAccueilVisiteur');
        // endif;

        ?>
        <div align='center'>
        <label for="categorie">Categorie : </label> 
        <select id="inputState"  name="categorie">
            <?php foreach ($Categories as $Categorie):
             echo '<option value="'.$Categorie['NOCATEGORIE'].'">'.$Categorie['LIBELLE'].'</option>'; 
             endforeach ?> 
        </select><br>

        <label for="marque">Marque : </label> 
        <select id="inputState"  name="marque"> 
            <?php foreach ($Marques as $Marque):
             echo '<option value="'.$Marque['NOMARQUE'].'">'.$Marque['NOM'].'</option>'; 
             endforeach ?> 
        </select>
        
        <label for="Libelle">Libelle : </label><br>
        <input type="text" name='Libelle' value=<?php echo set_value ('Libelle')?>><br>
        
        <label for="Detail">Detail : </label><br>
        <input type="text" name='Detail' value=<?php echo set_value ('Detail')?>><br>

        <label for="Image">Image : </label><br>
        <input type="input" name='Image' value=<?php echo set_value ('Image')?>><br>
        
        <label for="PrixHT">Prix Hors Taxes : </label><br>
        <input type="integer" name='PrixHT' value=<?php echo set_value ('PrixHT')?>><br>
        
        <label for="TauxTVA">Taux TVA : </label><br>
        <input type="integer" name='TauxTVA'value=<?php echo set_value ('TauxTVA')?>><br>
        
        <label for="Quantite">Quantite : </label><br>
        <input type="integer" name='Quantite' value=<?php echo set_value ('Quantite')?>><br>
        

        <button type="submit" name="submit"> Ajouter </button>
        </div>
        <?php form_close()?>
    </body>
</html>
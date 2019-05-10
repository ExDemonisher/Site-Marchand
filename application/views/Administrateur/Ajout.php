<html>
    <body>
        <?php echo validation_errors();
        echo form_open('Administrateur/Ajout') ?>
        <div align='center'>
        <label for="Categorie">Categorie : </label><br>
        <input type="text" name='Categorie' value=<?php echo set_value ('Categorie')?>><br>
        
        <label for="Marque">Numero de Marque : </label><br>
        <input type="text" name='Marque' value=<?php echo set_value ('Marque')?>><br>
        
        <label for="Libelle">Libelle : </label><br>
        <input type="text" name='Libelle' value=<?php echo set_value ('Libelle')?>><br>
        
        <label for="Detail">Detail : </label><br>
        <input type="text" name='Detail' value=<?php echo set_value ('Detail')?>><br>
        
        <label for="PrixHT">Prix Hors Taxes : </label><br>
        <input type="integer" name='PrixHT' value=<?php echo set_value ('PrixHT')?>><br>
        
        <label for="TauxTVA">Taux TVA : </label><br>
        <input type="integer" name='TauxTVA'value=<?php echo set_value ('TauxTVA')?>><br>
        
        <label for="Quantite">Quantite : </label><br>
        <input type="integer" name='Quantite' value=<?php echo set_value ('Quantite')?>><br>
        
        Date d'ajout : <br>
        <input type="Date" name='Date' value=<?php echo set_value ('DateAjout')?>><br>

        <input type="submit" name="submit" value="Ajouter" />
        </div>
    </body>
</html>
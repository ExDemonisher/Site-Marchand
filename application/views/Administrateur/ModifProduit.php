<html>
    <body>
        <form>
            <?php echo validation_errors();
            echo form_open('Administrateur/Modification') 
            ?>
            <label for="txtTitre">Nouveau Prix</label>
            <input type="input" name="NouvPrix" value="<?php echo set_value('NouvPrix'); ?>" /><br/>

            <label for="PrenomUser">Nouvelle Quantite</label>
            <input type="input" name="NousQty" value="<?php echo set_value('NouvQty'); ?>" /><br/>

            <input type="submit" name="submit" value="Confirmer" />
        </form>
    </body>
</html>
<?php echo validation_errors();
    echo form_open('Visiteur/Enregistrer') ?>
        <label for="txtTitre">Nom</label>
        <input type="input" name="NomUser" value="<?php echo set_value('NomUser'); ?>" /><br/>
        <label for="PrenomUser">Prénom</label>
        <input type="input" name="PrenomUser" value="<?php echo set_value('PrenomUser'); ?>" /><br/>
        <label for="AdresseUser">Adresse</label>
        <input type="input" name="AdresseUser" value="<?php echo set_value('AdresseUser'); ?>" /><br/>
        <label for="VilleUser">Ville</label>
        <input type="input" name="VilleUser" value="<?php echo set_value('VilleUser'); ?>" /><br/>
        <label for="CodePostUser">Code postal</label>
        <input type="input" name="CodePostUser" value="<?php echo set_value('CodePostUser'); ?>" /><br/>
        <label for="EmailUser">Email</label>
        <input type="input" name="EmailUser" value="<?php echo set_value('EmailUser'); ?>" /><br/>
        <label for="Mdp">Mot de passe</label>
        <input type="password" name="Mdp" value="<?php echo set_value('Mdp'); ?>" /><br/> 
        <label for="ConfirmMdp">Confirmez le mot de passe</label>
        <input type="password" name="ConfirmMdp" value="<?php echo set_value('ConfirmMdp'); ?>" /><br/>
        <h4>Le mot de passe doit être identique!</h4>

        <input type="submit" name="submit" value="S'enregistrer" />
    </form>
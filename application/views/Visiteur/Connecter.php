<?php
    echo validation_errors();
    echo form_open('Visiteur/Visiteur/Connecter') ?>
    <label for="EmailUser">Email</label>
    <input type="input" name="EmailUser" value="<?php echo set_value('EmailUser'); ?>" /><br/>
    <label for="Mdp">Mot de passe</label>
    <input type="password" name="Mdp" value="<?php echo set_value('Mdp'); ?>" /><br/> 
    
    <input type="submit" name="submit" value="Se connecter" />
</form> 





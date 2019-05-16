<html>
    <body>
        <form>
            <?php echo validation_errors();
            echo form_open('Administrateur/ModifPrix');

            // if((!is_null($this->session->profil)) and ($this->session->profil == "Administrateur")):
            //     // Redirect vers Partie Admin
            //     $this->load->view("Administrateur/ModifPrixProduit");
                
            // else:
            //     // Redirect vers Acceuil
            //     redirect('Visiteur/PageDAccueilVisiteur');
            // endif;
            // ?>
            
            <label for="NouvPrix">Nouveau Prix</label>
            <input type="input" name="NouvPrix" value="<?php echo set_value('NouvPrix'); ?>" /><br/>

            <input type="submit" name="submit" value="Confirmer" />
        </form>
    </body>
</html>
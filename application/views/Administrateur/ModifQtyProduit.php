<html>
    <body>
        <form>
            <?php echo validation_errors();
            echo form_open('Administrateur/ModifQty');

            if((!is_null($this->session->profil)) and ($this->session->profil == "Administrateur")):
                // Redirect vers Partie Admin
                $this->load->view("Administrateur/ModifQtyProduit");
                
            else:
                // Redirect vers Acceuil
                redirect('Visiteur/PageDAccueilVisiteur');
            endif;
            ?>

            <label for="NouvQty">Nouvelle Quantite</label>
            <input type="input" name="NouvQty" value="<?php echo set_value('NouvQty'); ?>" /><br/>

            <input type="submit" name="submit" value="Confirmer" />
        </form>
    </body>
</html>
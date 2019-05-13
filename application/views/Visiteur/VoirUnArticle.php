<?php
    echo '<h2>'.$unArticle['LIBELLE'].'</h2>';
    echo $unArticle['DETAIL'];
    echo '<p>'.img($unArticle['NOMIMAGE']).'<p>'; // Affiche directement l'image
    // Nota Bene : img_url($unArticle['cNomFichierImage']) aurait retourne l'url de l'image (cf. assets)
    echo '<p>'.anchor('visiteur/ListerLesArticlesAvecPagination','Retour à la liste des articles').'</p>';
?>
    <?php if((!is_null($this->session->profil)) and ($this->session->profil == "Administrateur"))
    {
        if($unArticle['DISPONIBLE']==1){
            echo '<a href="<?php echo base_url() ?>index.php/Administrateur/Indisponible">Passer Indisponible</a><br>';
        }
        Else {
            echo '<a href="<?php echo base_url() ?>index.php/Administrateur/Disponible">Passer Disponible</a><br>';
        }
        
    }
?>
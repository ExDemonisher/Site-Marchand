<html>
    <body>
        <?php
            echo '<h2>'.$unArticle['LIBELLE'].'</h2>';
            echo $unArticle['DETAIL'];
            echo '<p>'.img($unArticle['NOMIMAGE']).'</p>'; // Affiche directement l'image
            // Nota Bene : img_url($unArticle['cNomFichierImage']) aurait retourne l'url de l'image (cf. assets)
            echo '<p>'.anchor('visiteur/ListerLesArticlesAvecPagination','Retour à la liste des articles').'</p>';
        ?>
            <?php if((!is_null($this->session->profil)) and ($this->session->profil == "Administrateur"))
            {
                // var_dump($this->session);
                ?><a class="btn btn-primary" class="nav-link active" href="<?php echo base_url().'index.php/Administrateur/ModifPrix/'.$unArticle['NOPRODUIT']; ?>">Modifier le Prix</a><?php
                
                ?><a class="btn btn-primary" class="nav-link active" href="<?php echo base_url().'index.php/Administrateur/ModifQty/'.$unArticle['NOPRODUIT']; ?>">Modifier la Quantité</a><?php
                
                if($unArticle['DISPONIBLE']==1){
                    ?><a class="btn btn-primary" class="nav-link active" href="<?php echo base_url().'index.php/Administrateur/Indisponible/'.$unArticle['NOPRODUIT']; ?>">Passer Indisponible</a><?php
                }
                else {
                    ?><a class="btn btn-primary" class="nav-link active" href="<?php echo base_url().'index.php/Administrateur/Disponible/'.$unArticle['NOPRODUIT'];?>">Passer Disponible</a><?php
                }
                //if ($unArticle['QUANTITE']==0)
                //{
                //    redirect('Administrateur/Indisponible');
                //}

            }
        ?>
        
    </body>
</html>
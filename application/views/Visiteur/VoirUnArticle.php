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
                ?><a class="btn btn-primary" class="nav-link active" href="<?php echo base_url().'index.php/Administrateur/Modification/'.$unArticle['NOPRODUIT']; ?>">Modifier le Produit</a><?php
                
                if($unArticle['DISPONIBLE']==1){
                   //echo ('<a href="<?php echo base_url()index.php/Administrateur/Indisponible">Passer Indisponible</a><br>');?>
                    <a class="btn btn-primary" class="nav-link active" href="<?php echo base_url().'index.php/Administrateur/Indisponible/'.$unArticle['NOPRODUIT']; ?>">Passer Indisponible</a><?php
                }
                else {
                    
                    ?><a class="btn btn-primary" class="nav-link active" href="<?php echo base_url().'index.php/Administrateur/Disponible/'.$unArticle['NOPRODUIT'];?>">Passer Disponible</a><?php
                    //echo ('<a href="<?php echo base_url()index.php/Administrateur/Disponible">Passer Disponible</a><br>');
                }
                //if ($unArticle['QUANTITE']==0)
                //{
                //    redirect('Administrateur/Indisponible');
                //}

            }
        ?>
        
    </body>
</html>
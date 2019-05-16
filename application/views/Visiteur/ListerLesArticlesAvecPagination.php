<html>
    <body>
        <header class="page-header">

                <?php echo form_open('Visiteur/BarreDeRecherche', array("class"=>"form-inline")); ?> 
                <input name="recherche" class="form-control mr-sm-2" type="text" placeholder="Search"> 
                <button class="btn btn-primary" type="submit">Chercher</button> 
                <div class="btn-group"> <?php form_close(); ?>

        </header>
        <center><h2><?php echo $TitreDeLaPage ?></h2>
        
        
        <!-- données récupérées en 'mode objet' -->
        </br></br>
            <?php foreach ($lesArticles as $unArticle): 
            //if($unArticle['DISPONIBLE']==1)
            //{
                echo '<h3>'.anchor('visiteur/VoirUnArticle/'.$unArticle->NOPRODUIT,$unArticle->LIBELLE).'</h3>';
                echo '<img width="200" height="200" class="rounded-sm"'.img($unArticle->NOMIMAGE).'</img><br>';
            //}
            endforeach;
            echo $liensPagination;
            ?>
        </br></br>
            <!--<p>Pour avoir afficher le détail d'un article, cliquer sur son titre</p> -->
        </br></br>
    </body>
</html>

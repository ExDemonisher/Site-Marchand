<html>
    <body>
        <center><h2><?php echo $TitreDeLaPage ?></h2>
        <!-- données récupérées en 'mode objet' -->
        </br></br>
            <?php foreach ($lesArticles as $unArticle): 
            //if($unArticle['DISPONIBLE']==1)
            //{
                echo '<h3>'.anchor('visiteur/VoirUnArticle/'.$unArticle->NOPRODUIT,$unArticle->LIBELLE).'</h3>';
            //}
            //else
            //{
                //echo '<h3>'.('Ceci est un test').'</h3>';
            //}
            
            endforeach;
            echo $liensPagination;
            ?>
        </br></br>
            <!--<p>Pour avoir afficher le détail d'un article, cliquer sur son titre</p> -->
        </br></br>
    </body>
</html>

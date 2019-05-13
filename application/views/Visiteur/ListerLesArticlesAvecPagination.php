<html>
    <body>
        <center><h2><?php echo $TitreDeLaPage ?></h2>
        <!-- données récupérées en 'mode objet' -->
        </br></br>
            <?php foreach ($lesArticles as $unArticle): 
            //if dispo==1 then:
                echo '<h3>'.anchor('visiteur/VoirUnArticle/'.$unArticle->NOPRODUIT,$unArticle->LIBELLE).'</h3>';
            //end if
            endforeach;
            echo $liensPagination;
            ?>
        </br></br>
            <!--<p>Pour avoir afficher le détail d'un article, cliquer sur son titre</p> -->
        </br></br>
    </body>
</html>

<html>
    <body>
        <center><h2><?php echo $TitreDeLaPage ?></h2>
        <!-- données récupérées en 'mode objet' -->
        </br></br>
            <?php foreach ($lesArticles as $unArticle): 
                echo $unArticle->NOPRODUIT.'&nbsp;'.$unArticle->LIBELLE.'&nbsp;<br>';
            endforeach;
            echo $liensPagination;
            ?>
        </br></br>
            <!--<p>Pour avoir afficher le détail d'un article, cliquer sur son titre</p> -->
        </br></br>
    </body>
</html>

<html>
    <body>
        <center><h2><?php echo $TitreDeLaPage ?></h2>
        <!-- données récupérées en 'mode objet' -->
        </br></br>
            <?php foreach ($lesArticles as $unArticle): 
                echo '<h3>'.$unArticle['NOPRODUIT'].'  '.$unArticle['LIBELLE'].'</h3>';
            endforeach ?>
        </br></br>
            <!--<p>Pour avoir afficher le détail d'un article, cliquer sur son titre</p> -->
        </br></br>
    </body>
</html>
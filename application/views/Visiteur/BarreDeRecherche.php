<html>
    <body>
        <input type="text" class="searchBox" id="searchBox"> </input>
        <input type="submit" value="Search" class="btnInput" id="btnInput"> </input>
        <br><br>
        <?php
        echo '<hr>';
        echo '<h3> Liste de produits </h3>';
        echo '<table id="site_marchand"  class="table">';
        echo '<th> Libelle</th>';
        echo '<th> Detail </th>';
        echo '<th> Disponible </th>';

        foreach($BarreDeRecherche as $unArticle) {
            echo '<tr>
                    <td>'.$unArticle->LIBELLE.'</td>
                    <td>'.$unArticle->DETAIL.'</td>
                    <td>'.$unArticle->DISPONIBLE.'</td>
                </tr>';
        }
        echo '</table>';
        ?>
    </body>
</html>
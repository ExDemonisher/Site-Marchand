<html>
    <body>
        <?php
            echo form_open('ab/Resultat');
            echo form_label('Entrez la valeur de a :', 'Nombre_a');
            echo form_input('Nombre_a');
            echo form_label('Entrez la valeur de b :', 'Nombre_b');
            echo form_input('Nombre_b');
            echo form_submit('submit','Calcul!');
            echo form_close();
        ?>
    </body>
</html>
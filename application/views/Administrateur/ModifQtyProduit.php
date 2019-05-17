<html>
    <body>
        <div align='center'>
            <?php
                validation_errors();
                echo form_open('Administrateur/ModifQty');
                echo form_label('Nouvelle Quantite','NouvQty');
            ?>
            <br>
            <input type='number' name='NouvQty' value='<?php echo set_value('NouvQty'); ?>'/> 
            <input type='hidden' name='NoProduit' value='<?php print($this->uri->segment(3));?>' />
            <br>
            <?php
                echo form_submit('Confirmer','Confirmer');
                form_close();
            ?>
        </div>
    </body>
</html>
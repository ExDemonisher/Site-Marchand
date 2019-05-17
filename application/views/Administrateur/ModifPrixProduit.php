<html>
    <body>
        <div align='center'>
            <?php
                validation_errors();
                echo form_open('Administrateur/ModifPrix');
                echo form_label('Nouveaux Prix','NouvPrix');
            ?> 
            <br>
            <input type='number' name='NouvPrix' value='<?php echo set_value('NouvPrix'); ?>'/> 
            <input type='hidden' name='NoProduit' value='<?php print($this->uri->segment(3));?>' />
            <br>
            <?php
                echo form_submit('Confirmer','Confirmer');
                form_close();
            ?>
        </div>
    </body>
</html>
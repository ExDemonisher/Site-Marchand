<?php
validation_errors();
echo form_open('Administrateur/ModifPrix');

echo form_label('Nouveaux Prix','NouvPrix');
?> 
<input type='number' name='NouvPrix' value='<?php echo set_value('NouvPrix'); ?>'/> 
<input type='hidden' name='NoProduit' value='<?php print($this->uri->segment(3));?>' />
<?php
echo form_submit('test','test');
form_close();
?>

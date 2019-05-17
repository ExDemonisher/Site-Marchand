<?php
validation_errors();
echo form_open('Administrateur/ModifQty');

echo form_label('Nouvelle Quantite','NouvQty');
?> 
<input type='number' name='NouvQty' value='<?php echo set_value('NouvQty'); ?>'/> 
<input type='hidden' name='NoProduit' value='<?php print($this->uri->segment(3));?>' />
<?php
echo form_submit('test','test');
form_close();
?>

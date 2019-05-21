<html>
    
    <body>  
    <?php echo form_open('Visiteur/modifierPanier'); ?>

        <table cellpadding="5" cellspacing="1" style="width:95%">
        <tr>

                <th>Quantité</th>
                <th>Produit</th>
                <th style="text-align:right">Prix unitaire</th>
                <th style="text-align:right">Prix total</th>
                <th style="text-align:right">Supprimer du panier</th>
        </tr>

        <?php $i = 1; ?>

        <?php foreach ($this->cart->contents() as $items): ?>

                <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                <tr>
                        <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
                        <td>
                                <?php echo $items['name']; ?>

                                <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                        <p>
                                                <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                        <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                                <?php endforeach; ?>
                                        </p>

                                <?php endif; ?>

                        </td>
                        <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                        <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?>€</td>
                        <td style="text-align:right"><?php echo anchor('Visiteur/supprimerDuPanier/' . $items['rowid'], '<img width="60" heigth="60"'.img("supprimerPanier.png").'</img>'); ?></td>
                </tr>

        <?php $i++; ?>
        <?php endforeach; ?>

        <tr>
                <td colspan="2"> </td>
                <td class="right"><strong>Total</strong></td>
                <td class="right"><?php echo $this->cart->format_number($this->cart->total()); ?>€</td>
        </tr>
        </table>
        <a class="btn btn-primary" class="nav-link active" href="<?php echo base_url()?>index.php/Visiteur/passerCommandes">Commander</a>
        <input class="btn btn-primary" type="submit" name="submit" value="Modifier le panier"/>
        <a class="btn btn-primary" class="nav-link active" href="<?php echo base_url()?>index.php/Visiteur/supprimerPanier">Supprimer le panier</a>
    </body>

</html>

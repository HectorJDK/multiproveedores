<?php echo $this->AssetCompress->script('products-edit'); ?>
<div class="products form">

<?php
    echo $this->Form->hidden('product', array('id'=>'product', 'value' => json_encode($product)));
    echo $this->Form->create('Product');
    echo $this->Form->hidden('id', array('id'=>'id', 'value' => $product['Product']['id']));
?>

	<fieldset>
		<legend><?php echo __('Edit Product'); ?></legend>
	<?php
		echo $this->Form->input('Numero de pieza', array(
		    'name' => 'data[Product][manufacturer_id]',
		    'value' => $product['Product']['manufacturer_id']));

		echo $this->Form->input('Genérico', array(
            'name' => 'data[Product][generic]',
            'type' => 'checkbox',
            'checked' => $product['Product']['generic']? '1' : '0'));

    ?>
            <div id="attributes"></div>

	</fieldset>
<?php echo $this->Form->end('Actualizar'); ?>
</div>
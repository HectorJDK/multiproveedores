<div class="orders form">
<?php echo $this->Form->create('Order'); ?>
	<fieldset>
		<legend><?php echo __('Add Order'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('quote_id');
		echo $this->Form->input('state_id');
		echo $this->Form->input('quantity');
		echo $this->Form->input('total_price');
		echo $this->Form->input('unitary_price');
		echo $this->Form->input('deleted');
		echo $this->Form->input('rating');
		echo $this->Form->input('logistics');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
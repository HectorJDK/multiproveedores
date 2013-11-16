<div class="categories form">

<?php echo $this->Form->create('Category'); ?>
	<fieldset>
		<legend><?php echo __('Add Category'); ?></legend>
	<?php
		echo $this->Form->input('url');
		echo $this->Form->input('Supplier');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
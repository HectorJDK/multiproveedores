<div class="categories form">

<?php echo $this->Form->create('Origin'); ?>
	<fieldset>
		<legend><?php echo __('Add Origin'); ?></legend>
	<?php
		echo $this->Form->input('url');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
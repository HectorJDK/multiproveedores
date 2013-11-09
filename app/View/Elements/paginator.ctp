<p>
	<?php 
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}'))); ?>
</p>
<ul class="pagination pagination-center">
	<?php
	echo $this->Paginator->prev('' . __('< '), array(), null, array('class' => 'previous'));
	echo $this->Paginator->numbers(array('separator' => ' '));
	echo $this->Paginator->next(__('') . ' >', array(), null, array('class' => 'next disabled')); ?>
</ul>
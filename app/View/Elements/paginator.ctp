<ul class="pagination pagination-center">
  <p class="light">
  <?php $pages = $this->Paginator->counter(array('format' => '{:pages}'));
  	if ($pages > 1) {
  		echo $this->Paginator->counter(array('format' => __('Página {:page} de {:pages}. Mostrando {:current} records de {:count} en total')));	
  		echo $this->Paginator->prev('' . __('< '), array(), null, array('class' => 'previous'));
  		echo $this->Paginator->numbers(array('separator' => ' '));
  		echo $this->Paginator->next(__('') . ' >', array(), null, array('class' => 'next disabled'));
  	}
	?>
  </p>
</ul>
<ul class="pagination pagination-center">
  <p class="light">
  <?php echo $this->Paginator->counter(array('format' => __('Página {:page} de {:pages}. Mostrando {:current} records de {:count} en total'))); ?>
  </p>
  <?php
  echo $this->Paginator->prev('' . __('< '), array(), null, array('class' => 'previous'));
  echo $this->Paginator->numbers(array('separator' => ' '));
  echo $this->Paginator->next(__('') . ' >', array(), null, array('class' => 'next disabled')); ?>
</ul>
<?php echo $this->element('requests_actions'); ?>

<h2>Mis Solicitudes</h2>
<div class="filters">
  <span>Ordenar por:</span>
  <ul class="pagination pagination-inverse">
    <li><?php echo $this->Paginator->sort('origin_id', 'Pagina Web'); ?></li>
    <li><?php echo $this->Paginator->sort('created', 'Fecha de recepción'); ?></li>
  </ul>

</div>
<?php foreach ($requests as $request): ?>
  <div class="row striped slim">
    <div class="col-8">
      <?php if (is_null(!$request['Origin']['url'])): ?>
        <div class="row">
          <div class="col-3 text-right light">
            Página Origen:
          </div>
          <div class="col-9">
            <?php echo $this->Html->link($request['Origin']['url'], array('controller' => 'categories', 'action' => 'view', $request['Origin']['id'])); ?>
          </div>
        </div>
      <?php endif; ?>

      <div class="row">
        <div class="col-3 text-right light">
          Comentarios:
        </div>
        <div class="col-9 blue">
          <?php echo $request['Content']['comment']; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-3 text-right light">
          Fecha Creación:
        </div>
        <div class="col-9">
          <?php echo date('j M Y', strtotime(h($request['Request']['created']))); ?>&nbsp;
        </div>
      </div>

      <div class="inner-actions">
        <?php echo $this->Html->link(__('Ver Solicitud'), array('action' => 'view', $request['Request']['id']), array('class'=>'btn btn-info view')); ?>
        <?php
        if($request['Request']['quote_count'] > 0)
        {
          echo $this->Form->postLink(__('Ver Cotizaciones'), array('controller' => 'quotes', 'action' => 'index', $request['Request']['id']), array('class' => 'btn'));
        }
        else
        {
          echo $this->Form->postLink(__('Liberar Solicitud'), array('action' => 'release', $request['Request']['id']), array('class' => "btn btn-danger btn-highlight"));
        }
        ?>
        <?php //echo $this->Form->postLink(__('Liberar Solicitud'), array('action' => 'release', $request['Request']['id']), array('class' => "btn btn-danger btn-highlight")); ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<?php echo $this->element('paginator'); ?>
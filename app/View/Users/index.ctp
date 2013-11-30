<h1>Usuarios</h1>
<!-- <div class="add-user"><?php echo $this->Html->link("Add User", array('action' => 'add')); ?><a><i class="icon-user"></i></a></div> -->

<!-- Here's where we loop through our $usuarios array, printing out usuario info -->

<?php foreach ($users as $user): ?>
    <div class="row striped slim">
        <div class="col-8">
            <div class="row">
                <div class="col-3 text-right light">
                    Id:
                </div>
                <div class="col-3">
                    <?php echo $user['User']['id']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-3 text-right light">
                    Nombre:
                </div>
                <div class="col-3">
                    <?php echo $this->Html->link($user['User']['name'], array('action' => 'view', $user['User']['id'])); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-3 text-right light">
                    Nombre de Usuario:
                </div>
                <div class="col-3">
                    <?php echo $user['User']['username']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-3 text-right light">
                    Contraseña:
                </div>
                <div class="col-3">
                    <?php echo $user['User']['password']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-3 text-right light">
                    Email:
                </div>
                <div class="col-3">
                    <?php echo $user['User']['email']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-3 text-right light">
                    Creado:
                </div>
                <div class="col-3">
                    <?php echo $user['User']['created']; ?>
                </div>
            </div>

            <div class="inner-actions">
                <?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id']), array('class'=>'btn btn-info')); ?>

                <?php echo $this->Html->link('Delete', array('action' => 'delete', $user['User']['id']), array('class'=>'btn btn-danger')); ?>

            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php slot('title', 'Machines List') ?>

<h1 class="page-header">
  Machines List
</h1>

<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('machine/new') ?>" class="btn btn-primary">New</a>
  </div>
</div>

<table class="table table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody><?php foreach ($machines as $machine): ?>
    <tr>
      <td><a href="<?php echo url_for('machine/edit?id='.$machine->getId()) ?>"><?php echo $machine->getId() ?></a></td>
      <td><?php echo $machine->getName() ?></td>
      <td><?php echo $machine->getCreatedAt() ?></td>
      <td><?php echo $machine->getUpdatedAt() ?></td>
      <td><?php echo $machine->getCreator() ?></td>
      <td><?php echo $machine->getUpdator() ?></td>
    </tr>
  <?php endforeach; ?></tbody>
</table>

<?php slot('title', 'Pools List') ?>

<h1 class="page-header">
  Pools List
</h1>

<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('pool/new') ?>" class="btn btn-primary">New</a>
  </div>
</div>

<table class="table table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
      <th>Version</th>
    </tr>
  </thead>
  <tbody><?php foreach ($pools as $pool): ?>
    <tr>
      <td><a href="<?php echo url_for('pool/edit?id='.$pool->getId()) ?>"><?php echo $pool->getId() ?></a></td>
      <td><?php echo $pool->getName() ?></td>
      <td><?php echo truncate_text($pool->getDescription(), 800) ?></td>
      <td><?php echo $pool->getCreatedAt() ?></td>
      <td><?php echo $pool->getUpdatedAt() ?></td>
      <td><?php echo $pool->getCreatedBy() ?></td>
      <td><?php echo $pool->getUpdatedBy() ?></td>
      <td><?php echo $pool->getVersion() ?></td>
    </tr>
  <?php endforeach; ?></tbody>
</table>

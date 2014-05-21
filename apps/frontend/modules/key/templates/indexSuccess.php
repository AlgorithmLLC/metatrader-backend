<?php slot('title', 'Keys List') ?>

<h1 class="page-header">
  Keys List
</h1>

<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('key/new') ?>" class="btn btn-primary">New</a>
  </div>
</div>

<table class="table table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Product</th>
      <th>Machine</th>
      <th>Buyer</th>
      <th>Pool</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
    </tr>
  </thead>
  <tbody><?php foreach ($keys as $key): ?>
    <tr>
      <td><a href="<?php echo url_for('key/edit?id='.$key->getId()) ?>"><?php echo $key->getId() ?></a></td>
      <td><?php echo $key->getName() ?></td>
      <td><?php echo $key->getProductId() ?></td>
      <td><?php echo $key->getMachineId() ?></td>
      <td><?php echo $key->getBuyerId() ?></td>
      <td><?php echo $key->getPoolId() ?></td>
      <td><?php echo $key->getCreatedAt() ?></td>
      <td><?php echo $key->getUpdatedAt() ?></td>
      <td><?php echo $key->getCreator() ?></td>
      <td><?php echo $key->getUpdator() ?></td>
    </tr>
  <?php endforeach; ?></tbody>
</table>

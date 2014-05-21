<?php slot('title', 'Products List') ?>

<h1 class="page-header">
  Products List
</h1>

<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('product/new') ?>" class="btn btn-primary">New</a>
  </div>
</div>

<table class="table table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Metaname</th>
      <th>Description</th>
      <th>Package</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
      <th>Version</th>
    </tr>
  </thead>
  <tbody><?php foreach ($products as $product): ?>
    <tr>
      <td><a href="<?php echo url_for('product/edit?id='.$product->getId()) ?>"><?php echo $product->getId() ?></a></td>
      <td><?php echo $product->getName() ?></td>
      <td><?php echo $product->getMetaname() ?></td>
      <td><?php echo truncate_text($product->getDescription(), 800) ?></td>
      <td><?php echo $product->getPackage() ?></td>
      <td><?php echo $product->getCreatedAt() ?></td>
      <td><?php echo $product->getUpdatedAt() ?></td>
      <td><?php echo $product->getCreatedBy() ?></td>
      <td><?php echo $product->getUpdatedBy() ?></td>
      <td><?php echo $product->getVersion() ?></td>
    </tr>
  <?php endforeach; ?></tbody>
</table>

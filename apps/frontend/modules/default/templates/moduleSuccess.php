<div class="page-header">
  <h1>Module "<?php echo $sf_params->get('module') ?>" created</h1>
  <p class="lead">Congratulations! You have successfully created a symfony module.</p>
</div>

<dl>
  <dt>This is a temporary page</dt>
  <dd>This page is part of the symfony <code>default</code> module. It will disappear as soon as you override the <code>index</code> action in the new module.</dd>
</dl>

<dl>
  <dt>What's next</dt>
  <dd>
    <ul>
      <li>Browse to the <code>apps/<?php echo sfContext::getInstance()->getConfiguration()->getApplication() ?>/modules/<?php echo $sf_params->get('module') ?>/</code> directory</li>
      <li>In <code>actions/actions.class.php</code>, edit the <code>executeIndex()</code> method and remove the final <code>forward</code></li>
      <li>Customize the <code>templates/indexSuccess.php</code> template</li>
      <li><?php echo link_to('Learn more from the online documentation', 'http://www.symfony-project.org/doc') ?></li>
    </ul>
  </dd>
</dl>

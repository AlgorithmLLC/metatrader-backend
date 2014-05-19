<div class="page-header">
  <h1>Login Required</h1>
  <p class="lead">This page is not public.</p>
</div>

<dl>
  <dt>How to access this page</dt>
  <dd>You must proceed to the login page and enter your id and password.</dd>
</dl>

<p class="lead">
  What's next?
  <div class="btn-toolbar">
    <div class="btn-group">
      <a href="<?php echo url_for(sfConfig::get('sf_login_module').'/'.sfConfig::get('sf_login_action')) ?>" class="btn btn-primary">Proceed to login</a>
    </div>
    <div class="btn-group">
      <a href="javascript:history.go(-1)" class="btn">Back to previous page</a>
    </div>
  </div>
</p>

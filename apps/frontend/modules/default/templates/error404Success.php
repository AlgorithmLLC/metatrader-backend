<div class="page-header">
  <h1>Oops! Page Not Found</h1>
  <p class="lead">The server returned a 404 response.</p>
</div>

<dl>
  <dt>Did you type the URL?</dt>
  <dd>You may have typed the address (URL) incorrectly. Check it to make sure you've got the exact right spelling, capitalization, etc.</dd>
</dl>
<dl>
  <dt>Did you follow a link from somewhere else at this site?</dt>
  <dd>If you reached this page from another part of this site, please email us at <?php echo mail_to('[email]') ?> so we can correct our mistake.</dd>
</dl>
<dl>
  <dt>Did you follow a link from another site?</dt>
  <dd>Links from other sites can sometimes be outdated or misspelled. Email us at <?php echo mail_to('[email]') ?> where you came from and we can try to contact the other site in order to fix the problem.</dd>
</dl>

<p class="lead">
  What's next?
  <div class="btn-toolbar">
    <div class="btn-group">
      <a href="<?php echo url_for('@homepage') ?>" class="btn btn-primary">Go to homepage</a>
    </div>
    <div class="btn-group">
      <a href="javascript:history.go(-1)" class="btn">Back to previous page</a>
    </div>
  </div>
</p>

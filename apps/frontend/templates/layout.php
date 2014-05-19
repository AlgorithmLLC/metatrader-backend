<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <?php include_http_metas() ?>
  <?php include_metas() ?>
  <title><?php include_slot('title') ?></title>
  <link rel="shortcut icon" href="/favicon.ico" />
  <?php include_stylesheets() ?>
  <?php include_javascripts() ?>
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>

<body>
  <div class="navbar">
    <div class="navbar-inner">
      <div class="container">
        <a href="<?php echo url_for('@homepage') ?>" class="brand"><?php echo $_SERVER['SERVER_NAME'] ?></a>

        <ul class="nav">
          <li><a href="<?php echo url_for('default/error404') ?>">Test 404</a></li>
          <li><a href="<?php echo url_for('default/disabled') ?>">Test disabled</a></li>
          <li><a href="<?php echo url_for('default/login') ?>">Test login</a></li>
          <li><a href="<?php echo url_for('default/module') ?>">Test module</a></li>
          <li><a href="<?php echo url_for('default/secure') ?>">Test secure</a></li>
        </ul>

        <ul class="nav pull-right"><?php if ($sf_user->isAuthenticated()): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php echo $sf_user->getUsername() ?>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo url_for('sf_guard_signout') ?>">Log out</a></li>
            </ul>
          </li>
        </ul><?php endif ?>
      </div>
    </div>
  </div>

  <section id="content">
    <div class="container">
      <?php echo $sf_content ?>
    </div>
  </section>

  <footer id="footer">
    <div class="container" style="padding-top: 7em">
      Powered by <a href="http://github.com/b1rdex/symfony1">Symfony 1.4 "slowpoke" edition</a>
    </div>
  </footer>
</body>

</html>

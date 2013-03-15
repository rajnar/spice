<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example of Fluid Layout with Twitter Bootstrap version 2.0 from w3resource.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Example of Fluid Layout with Twitter Bootstrap version 2.0 from w3resource.com">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url();?>public/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url();?>public/bootstrap/css/example-fluid-layout.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url();?>public/bootstrap/images/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo base_url();?>public/bootstrap/images/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>public/bootstrap/images/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>public/bootstrap/images/images/apple-touch-icon-114x114.png">
  </head>
  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><img src="/images/w3r.png" width="111" height="30" alt="w3resource logo" /></a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
            <p class="navbar-text pull-right">Logged in as <a href="#">username</a></p>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Frontend</li>
              <li class="active"><a href="#">HTML 4.01</a></li>
              <li><a href="#">HTML5</a></li>
              <li><a href="#">CSS</a></li>
              <li><a href="#">JavaScript</a></li>
			  <li><a href="#">Twitter Bootstrap</a></li>
			  <li><a href="#">Firebug</a></li>
              <li class="nav-header">Backend</li>
              <li><a href="#">PHP</a></li>
              <li><a href="#">SQL</a></li>
              <li><a href="#">MySQL</a></li>
              <li><a href="#">PostgreSQL</a></li>
              <li><a href="#">MongoDB</a></li>
           </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="leaderboard">
            <h1>Learn. Practice. Develop.</h1>
            <p>w3resource offers web development tutorials. We believe in Open Source. Love standards. And prioritize simplicity 				             and readability while serving content.</p>
            <p><a class="btn btn-success btn-large">Join w3resource now</a></p>
          </div>
          <div class="row-fluid">
            <div class="span4">
              <h2>Learn</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-success btn-large" href="#">Start Learning now</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Practice</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-success btn-large" href="#">Start percticing now</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Develop</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-success btn-large" href="#">Start developing now</a></p>
            </div><!--/span-->
          </div><!--/row-->
          <hr>
     <footer>
        <p>© Company 2012</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>public/bootstrap/js/jquery.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-transition.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-alert.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-modal.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-tab.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-popover.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-button.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-collapse.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-carousel.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap-typeahead.js"></script>

  </body>
</html>
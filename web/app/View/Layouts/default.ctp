<?php
$cakeDescription = __d('cake_dev', 'Enterprise AppStore');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Hammer reload -->
<script>
setInterval(function(){
  try {
    if(typeof ws != 'undefined' && ws.readyState == 1){return true;}
    ws = new WebSocket('ws://'+(location.host || 'localhost').split(':')[0]+':35353')
    ws.onopen = function(){ws.onclose = function(){document.location.reload()}}
    ws.onmessage = function(){
      var links = document.getElementsByTagName('link'); 
        for (var i = 0; i < links.length;i++) { 
        var link = links[i]; 
        if (link.rel === 'stylesheet' && !link.href.match(/typekit/)) { 
          href = link.href.replace(/((&|\?)hammer=)[^&]+/,''); 
          link.href = href + (href.indexOf('?')>=0?'&':'?') + 'hammer='+(new Date().valueOf());
        }
      }
    }
  }catch(e){}
}, 1000)
</script>
<!-- Hammer reload -->

<link rel='stylesheet' href='<?php echo $this->Html->url('/', true); ?>assets/css/fullcalendar.css' />
<link rel='stylesheet' href='<?php echo $this->Html->url('/', true); ?>assets/css/datatables/datatables.css' />
<link rel='stylesheet' href='<?php echo $this->Html->url('/', true); ?>assets/css/datatables/bootstrap.datatables.css' />
<link rel='stylesheet' href='<?php echo $this->Html->url('/', true); ?>assets/scss/chosen.css' />
<link rel='stylesheet' href='<?php echo $this->Html->url('/', true); ?>assets/scss/font-awesome/font-awesome.css' />
<link rel='stylesheet' href='<?php echo $this->Html->url('/', true); ?>assets/css/app.css' />
<link rel='stylesheet' href='<?php echo $this->Html->url('/', true); ?>assets/css/cake.css' />
<link rel='stylesheet' href='<?php echo $this->Html->url('/', true); ?>assets/css/styles.css' />
<?php
if (isset($cssFiles)) foreach ($cssFiles as $file) { ?>
<link rel='stylesheet' href='<?php echo $this->Html->url('/', true); ?>assets/css/for_pages/<?php echo $file; ?>.css' />
<?php } ?>
<link href='http://fonts.googleapis.com/css?family=Oswald:300,400,700|Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
<link href="<?php echo $this->Html->url('/', true); ?>assets/favicon.ico" rel="shortcut icon" />
<link href="<?php echo $this->Html->url('/', true); ?>assets/apple-touch-icon.png" rel="apple-touch-icon" />
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
@javascript html5shiv respond.min
<![endif]-->

<title><?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?></title>
<script>
<!--
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-45380708-1', 'ridiculous-innovations.com');
ga('send', 'pageview');
-->
</script>
</head>

<body>
<div class="all-wrapper">
	<div class="row">
		<!-- Begin left menu -->
		<?php echo $this->element('Admin/leftMenu'); ?>
		<!-- End left menu -->
		<div class="col-md-9">
			<div class="content-wrapper<?php if (isset($woodWrapper)) echo $woodWrapper; if (isset($pageClass)) echo $pageClass; ?>">
				<div class="content-inner">
					<div class="page-header">
						<div class="header-links hidden-xs"> <a href="notifications.html"><i class="icon-comments"></i> User Alerts</a> <a href="<?php echo $this->Html->url('/users/myaccount', true); ?>"><i class="icon-cog"></i> My Account</a> <a href="<?php echo $this->Html->url('/users/logout', true); ?>"><i class="icon-signout"></i> Logout</a> </div>
						<h1><i class="icon-<?php echo (isset($pageIcon)) ? $pageIcon : 'exclamation-sign';  ?>"></i> <?php echo $title_for_layout; ?></h1>
					</div>
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li><a href="#">Bread</a></li>
						<li><a href="#">Crumbs</a></li>
						<li class="active">Example</li>
					</ol>
					<?php
/*
					echo $this->Html->getCrumbs(' > ', array(
						'text' => $this->Html->image('home.png'),
						'url' => array('controller'=>'pages', 'action'=>'display', 'home'),
						'escape' => false
					));
*/
					?>
					<div class="main-content">
						<div class="widget">
							<div class="alert alert-warning alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<i class="icon-exclamation-sign"></i> <strong>Welcome!</strong> This is a dashboard of the powerful admin template.
							</div>
						</div>
						<!-- Begin content -->
						<?php echo $this->fetch('content'); ?>
						<!-- End content -->
						<div class="widget cake-sql-log">
							<?php echo $this->element('sql_dump'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->element('Admin/configSideBar'); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/jquery.sparkline.min.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/bootstrap/tab.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/bootstrap/dropdown.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/bootstrap/collapse.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/bootstrap/transition.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/bootstrap/tooltip.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/jquery.knob.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/fullcalendar.min.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/datatables/datatables.min.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/chosen.jquery.min.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/datatables/bootstrap.datatables.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/raphael-min.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/morris-0.4.3.min.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/for_pages/color_settings.js'></script> 
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/application.js'></script>
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/methods.js'></script>
<?php
if (isset($jsFiles)) foreach ($jsFiles as $file) { ?>
<script src='<?php echo $this->Html->url('/', true); ?>assets/js/for_pages/<?php echo $file; ?>.js'></script>
<?php } ?>
</body>
</html>
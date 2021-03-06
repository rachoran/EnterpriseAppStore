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

<link rel='stylesheet' href='<?= $this->Html->url('/', true); ?>assets/css/fullcalendar.css' />
<link rel='stylesheet' href='<?= $this->Html->url('/', true); ?>assets/css/datatables/datatables.css' />
<link rel='stylesheet' href='<?= $this->Html->url('/', true); ?>assets/css/datatables/bootstrap.datatables.css' />
<link rel='stylesheet' href='<?= $this->Html->url('/', true); ?>assets/scss/chosen.css' />
<link rel='stylesheet' href='<?= $this->Html->url('/', true); ?>assets/scss/font-awesome/font-awesome.css' />
<link rel='stylesheet' href='<?= $this->Html->url('/', true); ?>assets/css/app.css' />
<link rel='stylesheet' href='<?= $this->Html->url('/', true); ?>assets/css/cake.css' />
<link rel='stylesheet' href='<?= $this->Html->url('/', true); ?>assets/css/styles.css' />

<?php
if (isset($cssFiles)) foreach ($cssFiles as $file) { ?>
<link rel='stylesheet' href='<?= $this->Html->url('/', true); ?>assets/css/for_pages/<?= $file; ?>.css' />
<?php } ?>

<?php
if (isset($ajaxFileUpload)) {
?>
<link rel="stylesheet" href="<?= $this->Html->url('/', true); ?>thirdparty/jQuery-File-Upload/css/jquery.fileupload.css" />
<link rel="stylesheet" href="<?= $this->Html->url('/', true); ?>thirdparty/jQuery-File-Upload/css/jquery.fileupload-ui.css" />
<?php	
}
?>

<link href='http://fonts.googleapis.com/css?family=Oswald:300,400,700|Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
<link href="<?= $this->Html->url('/', true); ?>assets/favicon.ico" rel="shortcut icon" />
<link href="<?= $this->Html->url('/', true); ?>Userfiles/Settings/Images/Logo" rel="apple-touch-icon" />
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
@javascript html5shiv respond.min
<![endif]-->

<title><?= $siteName; ?>: <?= $title_for_layout; ?></title>

<!-- Begin google analytics -->
<?= $this->element('Admin/ga'); ?>
<!-- End google analytics -->

</head>

<body>
<div class="all-wrapper">
	<div class="row">
		<!-- Begin left menu -->
		<?= $this->element('Menu/leftMenu'); ?>
		<!-- End left menu -->
		<div class="col-md-9">
			<div class="content-wrapper<?php if (isset($woodWrapper)) echo $woodWrapper; if (isset($pageClass)) echo $pageClass; ?>">
				<div class="content-inner">
					<div class="page-header">
						<div class="header-links hidden-xs">
							<!--<a href="notifications.html"><i class="icon-comments"></i> User Alerts</a>-->
							<a href="<?= $this->Html->url('/users/account', true); ?>"><i class="icon-cog"></i> My Account</a>
							<a href="<?= $this->Html->url('/users/logout', true); ?>"><i class="icon-signout"></i> Logout</a>
						</div>
						<h1><i class="icon-<?= (isset($pageIcon)) ? $pageIcon : 'exclamation-sign';  ?>"></i> <?= $title_for_layout; ?></h1>
					</div>
					<!--
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li><a href="#">Bread</a></li>
						<li><a href="#">Crumbs</a></li>
						<li class="active">Example</li>
					</ol>
					-->
					<?php
					$options = array();
					$options['class'] = 'breadcrumb';
					$options['lastClass'] = 'active';
					echo $this->Html->getCrumbList($options, 'Home');
					?>
					<div class="main-content">
						<!-- Begin errors -->
						<?= $this->element('Admin/errors'); ?>
						<!-- End errors -->
						
						<!-- Begin content -->
						<?= $this->fetch('content'); ?>
						<!-- End content -->
						
						<?php if ($debugMySQL) { ?>
						<div class="widget cake-sql-log">
							<?= $this->element('sql_dump'); ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--
<div class="row">
		<div class="col-md-3">
		
		</div>
		<div class="col-md-9">
			<div class="content-wrapper">
				<div class="content-inner">
					<div class="wrapper footer">
						<span class="pull-left">Copyright &copy; <?= date('Y'); ?> <a href="http://www.ridiculous-innovations.com/" title="We are RoboCop!">Ridiculous Innovations</a></span>
						<span class="pull-right">Development partner <a href="http://www.fuerteint.com/" title="Mobile development agency">Fuerte International</a></span>
						&nbsp;
					</div>
				</div>
			</div>
		</div>
	</div>
-->
</div>
<?php
// TODO: Add configurable sidebar
//echo $this->element('Admin/configSideBar');
?>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> --> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/jquery.js'></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>  -->
<script src="<?= $this->Html->url('/', true); ?>assets/js/jquery-ui.min.js"></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/jquery.cookie.js'></script>
<script src='<?= $this->Html->url('/', true); ?>assets/js/jquery.sparkline.min.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/bootstrap/tab.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/bootstrap/dropdown.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/bootstrap/collapse.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/bootstrap/transition.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/bootstrap/tooltip.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/jquery.knob.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/fullcalendar.min.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/datatables/datatables.min.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/chosen.jquery.min.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/datatables/bootstrap.datatables.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/raphael-min.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/morris-0.4.3.min.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/for_pages/color_settings.js'></script> 
<script src='<?= $this->Html->url('/', true); ?>assets/js/application.js'></script>
<script src='<?= $this->Html->url('/', true); ?>assets/js/environment.js'></script>
<?php
if (isset($ajaxFileUpload)) {
?>
<script src="<?= $this->Html->url('/', true); ?>thirdparty/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
<script src="<?= $this->Html->url('/', true); ?>thirdparty/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
<script src="<?= $this->Html->url('/', true); ?>thirdparty/jQuery-File-Upload/js/jquery.fileupload.js"></script>
<?php	
}
?>
<script type="text/javascript">
env.baseUrl = '<?= $this->Html->url('/', true); ?>';
</script>
<?php
if (isset($jsFiles)) foreach ($jsFiles as $file) { ?>
<script src='<?= $this->Html->url('/', true); ?>assets/js/for_pages/<?= $file; ?>.js'></script>
<?php
}
?>
</body>
</html>
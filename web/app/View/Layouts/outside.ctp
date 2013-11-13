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
<link rel='stylesheet' href='<?= $this->Html->url('/', true); ?>assets/css/login.css' />

<?php
if (isset($cssFiles)) foreach ($cssFiles as $file) { ?>
<link rel='stylesheet' href='<?= $this->Html->url('/', true); ?>assets/css/for_pages/<?= $file; ?>.css' />
<?php } ?>


<link href='http://fonts.googleapis.com/css?family=Oswald:300,400,700|Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
<link href="<?= $this->Html->url('/', true); ?>assets/favicon.ico" rel="shortcut icon" />
<link href="<?= $this->Html->url('/', true); ?>Userfiles/Settings/Images/Logo" rel="apple-touch-icon" />
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
@javascript html5shiv respond.min
<![endif]-->

<title><?= $siteName; ?>: <?= $title_for_layout; ?></title>

<!-- Begin google analytics -->
<?php echo $this->element('Admin/ga'); ?>
<!-- End google analytics -->

</head>

<body>


<div class="all-wrapper no-menu-wrapper outside<?php if (isset($pageClass)) echo $pageClass; ?>">
	<div class="login-logo-w">
		<a href="<?= $this->Html->url('/', true); ?>" class="logo">
			<img src="<?= $this->Html->url('/', true); ?>Userfiles/Settings/Images/Logo?time=<?= time(); ?>" alt="Go to Dashboard" class="logo" />
			<span><?= $siteName; ?></span>
		</a>
	</div>
	<div class="row">
	    <div class="col-md-4 col-md-offset-4">
			<div class="content-wrapper bold-shadow">
				<div class="content-inner">
					<div class="main-content main-content-grey-gradient no-page-header">
						<div class="main-content-inner">
							<!-- Begin errors -->
							<?php echo $this->element('Admin/errors'); ?>
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
	</div>
</div>

</body>
</html>
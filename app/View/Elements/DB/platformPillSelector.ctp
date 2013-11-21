<li class="active"><a href="#all" data-toggle="pill">All</a></li>
<?php
$platforms = Platforms::count($data);
foreach ($platforms as $icon=>$name) {
	echo '<li><a href="#'.$icon.'" data-toggle="pill">'.$name.'</a></li>';
}
?>

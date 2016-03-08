<body onload='init();'>

<div class="left-containt">
<div class="videoAndImage">
	<video class="video" name='video'>
	You bower doesn't support video tags </br>
	Pliz uninstall your IE
	</video>
	<canvas id="canvas-hidden" width='1000px' height='1000px' style="display:none;"></canvas>
	</br>
	<img class="snapshot" src=""></img>
	</br>
	<center>
	<input type='button' width='50px' onclick='snapshot()' value='Snapshot'>
	<input type='button' onclick='send("send")' value='Send'>
	</center>
</div>


<div>
Upload local file:
<input type="file" id="files" accept="image/*" data-buttonText="Upload local image" />
</div>

<center>
<?php // Get all cliparts
echo '<div class="cliparts-containt grid-4">'.PHP_EOL;

$dir = "assets/cliparts/";
$list = scandir($dir);

foreach ($list as $i => $path)
{
	$path = $dir . $path;
	if (preg_match("/.*\\.png/", $path))
		echo '
		<label>
		<input class="cliparts-radio" type="radio"
		name="cliparts" value="'.$path.'">
		<img class="cliparts" src="' . $path . '">
		</label>' . PHP_EOL;
}

echo "</div>".PHP_EOL;
?>
</center>
</div>
<div class="galerie_montage">
<?PHP
require_once("model/image.model.php");
$imgs = load_images_by_user_id($user->getId());

foreach ($imgs as $i => $img)
{
	if ($i >= 4)
		break ;
	echo "<img src='" . $img["path"]  . "'></img></br>";
}
?>
</div>

<script type='text/javascript' src='assets/js/montage.js'></script>

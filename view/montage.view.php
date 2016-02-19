<body onload='init();'>

<div class="left-containt">
<div class = "videoAndImage">
	<video class="video" name='video'>
	You bower doesn't support video tags </br>
	Pliz uninstall your IE
	</video>
	<canvas width='1000px' height='1000px' style="display:none;"></canvas>
	</br>
	<img class="snapshot" src=""></img>
	</br>
	<center>
	<input type='button' width='50px' onclick='snapshot()' value='Snapshot'>
	<input type='button' onclick='send("send")' value='Send'>
	</center>
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
<?PHP
	require_once("model/image.model.php");
	 $imgs = load_images_by_user_id(0);
	 foreach ($imgs as $i => $img)
	 	echo "<img src='" . $img["path"]  . "'></img></br>";
?>


<script>
'use strict'
var canvas;
var ctx;
var localMediaStream;
var video;
var img;
var req = new XMLHttpRequest();

function init()
{
	navigator.getUserMedia = ( navigator.getUserMedia ||
		navigator.webkitGetUserMedia ||
		navigator.mozGetUserMedia ||
		navigator.msGetUserMedia);

	canvas = document.querySelector('canvas');
	ctx = canvas.getContext('2d');
	localMediaStream = null;
	video = document.querySelector('video');
	img = document.querySelector('img');
	if (navigator.getUserMedia) {
		navigator.getUserMedia (
	{
		video: true,
		audio: false
	},

	// successCallback
	function(stream) {
		localMediaStream = stream;

		video.src = window.URL.createObjectURL(localMediaStream);
		console.log("wait");
		video.play();
	},

		// errorCallback
		function(err) {
			console.log("The following error occured: ");
			console.log(err);
		}
	);
	} else {
		console.log("getUserMedia not supported");
	}
	snapshot();
}

function snapshot() {
	if (localMediaStream) {
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		ctx.drawImage(video, 0, 0);
		img.src = canvas.toDataURL("image/jpeg");
		send("snap");
	}
}

function send(type) {
	var json_upload = "img=" + canvas.toDataURL("image/png");
	var xmlhttp = new XMLHttpRequest();

	// Get cliparts checked
	var radios = document.getElementsByName('cliparts');
	var cliparts = false;
	for (var i = 0, length = radios.length; i < length; i++) {
		if (radios[i].checked) {
			cliparts = radios[i].value;
		}
	}
	if (!cliparts)
	{
		alert("You must select a cliparts");
		return ;
	}

	xmlhttp.open("POST", "index.php?href=montage&clean"
		+"&type=" + type
		+ "&cliparts=" + cliparts
		, false);
	xmlhttp.onload = function (e) {
		var res;

		res = xmlhttp.responseText;
		console.log("load: ");
		console.log(e);
		img.src = res + "?" + new Date().getTime();;
	}
	xmlhttp.onerror = function (e) {
		console.log("ERROR");
		console.log(e);
	}
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(json_upload);
}
</script>
</body>

<body onload='init();'>
<input type='button' onclick='snapshot()' value='Take snapshot'></button>
<input type='button' onclick='send()' value='Send'></button>
<img width='500px' height='400px' src=""></img>
<video width='500px' height='400px' name='video'></video>
<canvas width='1000px' height='1000px'></canvas>

<script>
'use strict'
// <canvas width='1000px' height='1000px' style="display:none;"></canvas>
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

	}
}

function send() {
	/*
	req.open("POST", "index.php?href=montage&type=send");
	req.onload = function (e) {
		console.log("load2: " + req.responseText);
		// console.log("load2: " + req.status);
	}
	req.onerror = function (e) {
		console.log("Error: " + e);
	}
	req.send(JSON.stringify(a));
	req.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	req.send("lol=SALUT");
	*/
	var json_upload = "img=" + canvas.toDataURL("image/jpeg");
	var xmlhttp = new XMLHttpRequest();   // new HttpRequest instance 
	xmlhttp.open("POST", "index.php?href=montage&type=send", false);
	xmlhttp.onload = function (e) {
		var res;
		res = xmlhttp.responseText;
		res = res;
		console.log("load: " + res);
		img.src = res;
	}
	xmlhttp.onload = function (e) {
		console.log("ERROR");
		console.log(e);
	}
console.log(json_upload);
//	xmlhttp.setRequestHeader('Content-Type', 'application/upload');
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(json_upload);
}
</script>
</body>

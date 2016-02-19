'use strict'

var canvas;
var ctx;
var localMediaStream;
var video;
var img;
var req = new XMLHttpRequest();

function init()
{
	navigator.getUserMedia = (navigator.getUserMedia ||
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

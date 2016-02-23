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

	canvas = document.querySelector('#canvas-hidden');
	ctx = canvas.getContext('2d');
	localMediaStream = null;
	video = document.querySelector('.video');
	img = document.querySelector('.snapshot');
	document.getElementById('files').addEventListener('change', handleFileSelect, false);

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
}

function handleFileSelect(evt) {
	var files = evt.target.files; // FileList object

	// files is a FileList of File objects. List some properties.
	for (var i = 0, f; f = files[i]; i++) {
		var reader = new FileReader();
		reader.addEventListener("load", function (event) {
			var picFile = event.target;
			var div = document.createElement("div");
			img.src = picFile.result;
			
			ctx.drawImage(img, 0, 0);
			send("snap");
		});
		reader.readAsDataURL(f);
	}
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
		img.src = res + "?" + new Date().getTime();
		if (type == "send")
		{
			var newimg = document.createElement("img");
			var gal = document.querySelector(".galerie_montage");
			newimg.src = res;
			gal.insertBefore(newimg, gal.childNodes[0]);
		}
	}
	xmlhttp.onerror = function (e) {
		console.log(e);
	}
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(json_upload);
}

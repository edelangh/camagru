'use strict'

// http://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
function getParameterByName(name, url) {
	if (!url) url = window.location.href;
	name = name.replace(/[\[\]]/g, "\\$&");
	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function unlike(id)
{
	var xmlhttp = new XMLHttpRequest();
	var page = getParameterByName("page");
	page = page ? page : 1;

	xmlhttp.open("POST", "index.php?href=acceuil&clean"
				 + "&action=unlike"
				 + "&page=" + page
			, false);
		xmlhttp.onload = function (e)
		{
			console.log("success");
			location.reload();
		}
		xmlhttp.onerror = function (e)
		{
			console.log("error");
			console.log(e);
		}
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlhttp.send("id="+id);
}

function like(id)
{
	var xmlhttp = new XMLHttpRequest();
	var page = getParameterByName("page");
	page = page ? page : 1;

	xmlhttp.open("POST", "index.php?href=acceuil&clean"
				 + "&action=like"
				 + "&page=" + page
			, false);
		xmlhttp.onload = function (e)
		{
			console.log("success");
			location.reload();
		}
		xmlhttp.onerror = function (e)
		{
			console.log("error");
			console.log(e);
		}
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlhttp.send("id="+id);
}

function post_comment(id)
{
	var input = document.querySelector("#message-"+id);
	var message = input.value;
	var xmlhttp = new XMLHttpRequest();
	var page = getParameterByName("page");
	page = page ? page : 1;

	xmlhttp.open("POST", "index.php?href=acceuil&clean"
				 + "&action=comment"
				 + "&page=" + page
			, false);
		xmlhttp.onload = function (e)
		{
			console.log("success");
			location.reload();
		}
		xmlhttp.onerror = function (e)
		{
			console.log("error");
			console.log(e);
		}
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlhttp.send("id="+id+"&message="+message);
}

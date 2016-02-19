'use strict'

function unlike(id)
{
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.open("POST", "index.php?href=acceuil&clean"
				 + "&action=unlike"
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

	xmlhttp.open("POST", "index.php?href=acceuil&clean"
				 + "&action=like"
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

	xmlhttp.open("POST", "index.php?href=acceuil&clean"
				 + "&action=comment"
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

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

function get_xmlhttp(action)
{
	var xmlhttp = new XMLHttpRequest();
	var page = getParameterByName("page");
	var nbr = getParameterByName("page");
	nbr = nbr ? nbr : 3;
	page = page ? page : 1;

	xmlhttp.open("POST", "index.php?href=acceuil&clean"
				 + "&action=" + action
				 + "&page=" + page
				 + "&nbr=" + nbr
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
		return (xmlhttp);
}

function unlike(id)
{
	var xmlhttp = get_xmlhttp("unlike");

	xmlhttp.send("id="+id);
}

function like(id)
{
	var xmlhttp = get_xmlhttp("like");

	xmlhttp.send("id="+id);
}

function delete_image(id)
{
	var xmlhttp = get_xmlhttp("delete");

	xmlhttp.send("id="+id);
}

function post_comment(id)
{
	var input = document.querySelector("#message-"+id);
	var message = input.value;
	var xmlhttp = get_xmlhttp("comment");

	xmlhttp.send("id="+id+"&message="+message);
}

'use strict'

function checkpass(champ)
{
	var elem = document.getElementById(champ);
	if (elem.value.length < 8)
		elem.style.background = "red";
	else
		elem.style.background = "green";
}

function checkUserName()
{
	var elem = document.getElementById("login");
	var xhr = getXMLHttpRequest();
	

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
		}
	};
	xhr.onload = function (e) {
			if (xhr.responseText == "ok")
				elem.style.background = "green";
			else
				elem.style.background = "red";
		console.log(xhr.responseText);
	};
	xhr.open("POST", "index.php?href=inscription&action=js&clean", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("name=" + elem.value);
	console.log(xhr);
}


function getXMLHttpRequest()
{
	var xhr = null;

	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}

	return xhr;
}

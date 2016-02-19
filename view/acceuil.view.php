<?PHP
$imgs = load_images();

foreach ($imgs as $i => $img)
{
	$comment = unserialize($img["comment"]);
	$comments = $comment->getComments();
	$id = $img['id'];

	echo "<div class='content'>";
	echo "<img src='" . $img['path']  . "'></img>";
	echo "<div class='comment-content'>";
	if ($comments)
		foreach ($comments as $y => $message)
			echo "<div class='comment'>" . $message  . "</div>";
	echo "</div>";
	if (isset($_SESSION['user']))
		echo "<input type='text' id='message-".$id."' name='message'>
		<input type='button' onclick='post_comment(".$id.")' value='post'>";
	echo "</div>";
	echo "</br>".PHP_EOL;
}
?>

<script>
'use strict'

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
</script>

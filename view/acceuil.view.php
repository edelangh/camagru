<?PHP
echo "<table class='acceuil-table'>";
foreach ($imgs as $i => $img)
{
	///////////// IMAGE ///////////////
	$comment = unserialize($img["comment"]);
	$comments = $comment->getComments();
	$id = $img['id'];
	if (isset($_SESSION['user']))
		$user_id = $user->getId();
	$likes = $comment->getLikes();
	$like = isset($likes) ? array_sum($likes) : 0;

	echo "<tr>";
	echo "<td class='img-case'>";
	echo "<img src='" . $img['path']  . "'></img>";
	echo "</br>";
	///////////// LIKE ///////////////
	echo $like;
	if (!isset($user_id))
	{
		echo "<a href='?href=inscription'>
			<img class='like' src='assets/img/like.jpg'>
			</img></a>";
	}
	else
	{
		if (!isset($likes[$user_id]) || (isset($likes[$user_id]) && !$likes[$user_id]))
			echo "<img class='like' src='assets/img/like.jpg'
			onclick='like(".$id.")'></img>";
		else
			echo "<img class='unlike' src='assets/img/unlike.jpg'
			onclick='unlike(".$id.")'></img>";
	}
	///////////// COMMENT ///////////////
	echo "</td>";
	echo "<td class='comment-case'>";
	if ($comments)
		foreach ($comments as $y => $message)
			echo "<div class='comment'>" . $message  . "</div>";
	if (isset($_SESSION['user']))
		echo "<input type='text' id='message-".$id."' name='message'>
		<input type='button' onclick='post_comment(".$id.")' value='post'>";
	echo "</td>";
	echo "</tr>";
}
echo "</table>";
?>

<?PHP // Page navbar
echo "<div class='navbar'>" . PHP_EOL;
for ($i = 1; $i <= $page_count; ++$i)
	echo "<a href='?href=acceuil&page=".$i."'> ".$i." </a>" . PHP_EOL;
echo "</div>"
?>
<script type="text/javascript" src="assets/js/acceuil_comment.js"></script>

<?PHP

require_once("model/image.model.php");

$action = isset($_GET['action']);
$imgs = load_images();
$page = isset($_GET['page']) ? $_GET['page'] * 1 : 1;
$img_nbr = isset($_GET['nbr']) ? $_GET['nbr'] * 1 : 3;
unset($user);
if (isset($_SESSION['user']))
	$user = new userCon($_SESSION['user']);

if ($action && $user)
{
	$action = $_GET['action'];
	$id = $_POST['id'];
	if ($action == 'comment')
	{
		$message = htmlentities($_POST['message']);
		comment_image($id, $user->getName(), $message);

		$mail_message = "Bonjour l'une de vos images a recus un commentaire !\n"
			."Pour lire le commentaire: "
			.$LIEN_SITE."index.php?href=acceuil&page=".$page."\n";
		if (!mail($user->getEmail(), "Nouveau commentaire", $mail_message))
			echo "Un probleme est survenue lors de l'envoie du mail" . PHP_EOL;
	}
	else if ($action == 'like')
	{
		like_image($id, $user->getId());
		/*
		$mail_message = "Une personne a aimer votre image !\n"
						.$LIEN_SITE."index.php?href=acceuil&page=".$page."\n";
		if (!mail($user->getEmail(), "Nouveau commentaire", $mail_message))
			echo "Un probleme est survenue lors de l'envoie du mail" . PHP_EOL;
		 */
	}
	else if ($action == 'unlike')
	{
		unlike_image($id, $user->getId());
		/*
		$mail_message = "Une personne n'appreci plus votre image, desole.\n"
						.$LIEN_SITE."index.php?href=acceuil&page=".$page."\n";
		if (!mail($user->getEmail(), "Nouveau commentaire", $mail_message))
			echo "Un probleme est survenue lors de l'envoie du mail" . PHP_EOL;
		 */
	}
	else if ($action == 'delete')
	{
		delete_image($id, $user->getId());
		/*
		$mail_message = "Vous venez de supprimer une de vos image.\n"
						.$LIEN_SITE."index.php?href=acceuil&page=".$page."\n";
		if (!mail($user->getEmail(), "Suppression image", $mail_message))
			echo "Un probleme est survenue lors de l'envoie du mail" . PHP_EOL;
		 */
	}
}

if (count($imgs) % $img_nbr == 0)
	$page_count = floor(count($imgs) / $img_nbr);
else
	$page_count = floor(count($imgs) / $img_nbr + 1);
$imgs = array_slice($imgs, ($page - 1) * $img_nbr, $img_nbr);

if (!$clean)
{
	if (count($imgs) > 0)
		require_once("view/gallery.view.php");
	else
		require_once("view/acceuil_empty.view.php");
}
?>

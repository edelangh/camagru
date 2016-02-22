<?PHP

require_once("model/image.model.php");

$action = isset($_GET['action']);
unset($user);
if (isset($_SESSION['user']))
{
	$user = new userCon($_SESSION['user']);
}
if ($action && $user)
{
	$action = $_GET['action'];
	$id = $_POST['id'];
	if ($action == 'comment')
	{
		$message = $_POST['message'];
		comment_image($id, $user->getName(), $message);
	}
	else if ($action == 'like')
		like_image($id, $user->getId());
	else if ($action == 'unlike')
		unlike_image($id, $user->getId());
}
$imgs = load_images();
$page = isset($_GET['page']) ? $_GET['page'] * 1 : 1;
$img_nbr = isset($_GET['nbr']) ? $_GET['nbr'] * 1 : 3;

$page_count = floor(count($imgs) / $img_nbr) + 1;
$imgs = array_slice($imgs, ($page - 1) * $img_nbr, $img_nbr);

if (!$clean)
{
	if (count($imgs) > 0)
		require_once("view/acceuil.view.php");
	else
		require_once("view/acceuil_empty.view.php");
}
?>

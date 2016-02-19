<?PHP

require_once("model/image.model.php");

$action = isset($_GET['action']);

unset($user);
if (isset($_SESSION['user']))
{
	$user = new userCon($_SESSION['user']);
	echo "bonjour ".$user->getName();
}
if ($action && $user)
{
	$action = $_GET['action'];
	if ($action == 'comment')
	{
		$id = $_POST['id'];
		$message = $_POST['message'];

		comment_image($id, $user->getName(), $message);
	}
}
require_once("view/acceuil.view.php");
?>

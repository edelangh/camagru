<?PHP
require_once("model/image.model.php");
require_once("model/user.model.php");


if (!force_login())
	exit();


unset($user);
if (isset($_SESSION['user']))
	$user = new userCon($_SESSION['user']);

$action = isset($_GET['action']);
$imgs = load_images_by_user_id($user->getId());
$page = isset($_GET['page']) ? $_GET['page'] * 1 : 1;
$img_nbr = isset($_GET['nbr']) ? $_GET['nbr'] * 1 : 3;
if (count($imgs) % $img_nbr == 0)
	$page_count = floor(count($imgs) / $img_nbr);
else
	$page_count = floor(count($imgs) / $img_nbr + 1);
$imgs = array_slice($imgs, ($page - 1) * $img_nbr, $img_nbr);

if (!$clean)
		require_once("view/gallery.view.php");

?>

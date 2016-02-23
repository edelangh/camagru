<?PHP

require_once("model/image.model.php");
require_once("model/user.model.php");

force_login();

unset($user);
if (isset($_SESSION['user']))
	$user = new userCon($_SESSION['user']);

if (isset($_GET['type']))
{
	$type = $_GET['type'];
	$cliparts_path = $_GET['cliparts'];

	if ($type == 'send' || $type == 'snap')
	{
		$data = $_POST['img'];
		list($format, $data) = explode(';', $data, 2);
		list(, $data)      = explode(',', $data, 2);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);
/*
$path = $_FILES["image"]["tmp_name"];
$img = imagecreatefrompng($path);
imagepng($img, "out.png");
 */
		global $IMAGES_PATH;

		$id = $user->getId();
		$path = $IMAGES_PATH . "/".$id.".png";
		if ($type == 'snap')
			file_put_contents($path, $data);
		else
			$path = save_image($id, $user->getName(), $data);
		imagefusion($path, $cliparts_path, $path);
		echo $path;
	}
	else
		echo "Invalide type";
}
else
{
	require_once("view/montage.view.php");
}
?>


<?PHP

require_once("model/image.model.php");
require_once("model/user.model.php");

force_login();

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

		global $IMAGES_PATH;

		$path = $IMAGES_PATH . "/0.png";
		if ($type == 'snap')
			file_put_contents($path, $data);
		else
			$path = save_image(0, "kuti", $data);
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


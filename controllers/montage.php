<?PHP

if (isset($_GET['type']) && $_GET['type'] == 'send')
{
	$data = $_POST['img'];
	list($type, $data) = explode(';', $data, 2);
	list(, $data)      = explode(',', $data, 2);
	$data = str_replace(' ', '+', $data);
	$data = base64_decode($data);

	file_put_contents('image.jpeg', $data);
}
else
	require_once("view/montage.view.php");
?>


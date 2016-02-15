<?PHP
require_once("config/config.php");
include("config/root.php");

if (isset($_GET["href"]) && isset($GLOBALS["root"][$_GET["href"]]))
{
	$root = $GLOBALS["root"][$_GET["href"]];
	require_once($root);
}
else
	header("Location:index.php?href=acceuil");
?>

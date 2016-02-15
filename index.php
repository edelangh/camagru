<?PHP
	require_once("config.php");
require_once("root.php");

if (isset($_GET["href"]) && isset($GLOBALS["root"][$_GET["href"]]))
	$root = $GLOBALS["root"][$_GET["href"]];
else
	$root = "";
if ($root)
	require_once($root);
else
	require_once("./index.php");
?>

<?PHP
	require_once("config.php");
require_once("root.php");

$root = $GLOBALS["root"][$_GET["href"]];
if ($root)
	require_once($root);
else
	require_once($GLOBALS["root"]["404"]);
?>

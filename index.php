<?PHP
require_once("config/config.php");
include("config/root.php");
require("model/userCon.class.php");
session_start();


if (isset($_GET["href"]) && isset($GLOBALS["root"][$_GET["href"]]))
{
	$body = $GLOBALS["root"][$_GET["href"]];
	$clean  = isset($_GET["clean"]);

	if (!$clean)
		require_once($GLOBALS["root"]["header"]);
	try {
		require_once($body);
	} catch (PDOException $e) {
		echo $e->getMessage();
		header("Location:index.php?href=inscription&error=db");
		exit();
	} catch (Exception $e) {
		echo $e->getMessage();
		header("Location:index.php?href=inscription&error=else");
		exit();
	}
	if (!$clean)
		require_once($GLOBALS["root"]["footer"]);
}
else
	header("Location:index.php?href=acceuil");

?>

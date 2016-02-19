<?PHP
require("config/config.php");
require("config/root.php");
require("config/tools/mysql.php");

/*
 ** Usage:
 **	$imgs = load_images_by_user_id(0);
 **	foreach ($imgs as $i => $img)
 **		echo "<img src='" . $img["path"]  . "'></img></br>";
 */

class Comments
{
	public $comments;
	public $description;
	public $likes;
	public $unlikes;

	public function __contruct()
	{
		$this->comments = [];
		$this->description = "";
		$this->likes = [];
		$this->unlikes = [];
	}

	public function comment($user, $comment)
	{
		$message = $user . ": ". $comment;
		$this->comments[] = $message;
	}
	public function getComments()
	{
		return ($this->comments);
	}
}

function save_image($user_id, $name, $data)
{
	global $IMAGES_PATH;
	global $db;

	$date = new DateTime();
	date_default_timezone_set('Europe/Paris');
	$timestamp = $date->getTimestamp();
	$time = date('Y-m-d H:i:s', $timestamp);

	$path = $IMAGES_PATH ."/". $timestamp . "." . $user_id .".". $name . ".png";

	$comment = new Comments();
	$comment_json = serialize($comment);

	$req = $db->prepare("INSERT INTO `camagru`.`images` (`user_id`, `name`, `comment`, `path`, `timestamp`) VALUES (:user_id, :name, :comment, :path, :timestamp)");
	$req->execute(array(
		':user_id' => $user_id,
		':name' => $name,
		':comment' => $comment_json,
		':path' => $path,
		':timestamp' => $time));
	file_put_contents($path, $data);
	return ($path);
}

function load_images()
{
	global $db;

	$req = $db->prepare("SELECT * FROM `camagru`.`images`");
	$req->execute();
	$tab = $req->fetchAll();
	return $tab;
}

function load_images_by_user_id($user_id)
{
	global $db;

	$req = $db->prepare("SELECT * FROM `camagru`.`images` WHERE `user_id` = :user_id");
	$req->execute(array(':user_id' => $user_id));
	$tab = $req->fetchAll();
	return $tab;
}

function comment_image($id, $user, $message)
{
	global $db;

	$req = $db->prepare("SELECT * FROM `camagru`.`images` WHERE `id` = :id");
	$req->execute(array(':id' => $id));
	$img = $req->fetch();

	$comment = unserialize($img['comment']);
	$comment->comment($user, $message);
	$comment_json = serialize($comment);

	$req = $db->prepare("UPDATE `camagru`.`images`
		SET comment=:comment
		WHERE `id`=:id");
	$req->execute(array(':id' => $id, ':comment' => $comment_json));
}

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
	$cut = imagecreatetruecolor($src_w, $src_h); 
	imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); 
	imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 
	imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); 
}

function imagefusion($src_a, $src_b, $out)
{
	$a = $src_a;
	$b = $src_b;
	$a = imagecreatefrompng($a);
	$b = imagecreatefrompng($b);

	imagecopymerge_alpha($a, $b, 0,0,0,0, imagesx($b), imagesy($b), 100);

	imagesavealpha($a, true);
	imagepng($a, $out);
	imagedestroy($a);
	imagedestroy($b);
}
?>

<?

$raw = file_get_contents('chat.txt');
if ($raw == "")
	$chat = array();
else
	$chat = unserialize($raw);

array_push($chat, array(
    "id"   => $_POST["id"],
	"user" => $_POST["user"],
	"time" => time(),
	"msg"  => $_POST["msg"])
);

file_put_contents('chat.txt', serialize($chat));

?>
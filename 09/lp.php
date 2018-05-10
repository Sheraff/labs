<?
define('MESSAGE_POLL_MICROSECONDS', 500000);
define('MESSAGE_TIMEOUT_SECONDS', 30);
define('MESSAGE_TIMEOUT_SECONDS_BUFFER', 5);

$last_msg = $_POST["last_msg"];
$last_usr = $_POST["last_usr"];

session_write_close();

set_time_limit(MESSAGE_TIMEOUT_SECONDS+MESSAGE_TIMEOUT_SECONDS_BUFFER);
$counter = MESSAGE_TIMEOUT_SECONDS;


while($counter > 0) {
	//if there is data, break
	$chat = unserialize(file_get_contents('chat.txt'));
	if(!is_null($chat[$last_msg+1])) {
		$data = array("type" => "msg");
		while(!is_null($chat[$last_msg+1])){
			$last_msg++;
			$data["$last_msg"] = array(

			    "id"   => $chat[$last_msg]["id"],
				"user" => $chat[$last_msg]["user"],
				"time" => $chat[$last_msg]["time"],
				"msg"  => $chat[$last_msg]["msg"]);
		}
		break;
	}

	$users = unserialize(file_get_contents('users.txt'));
	if(!is_null($users[$last_usr+1])) {
		$data = array("type" => "usr");
		while(!is_null($users[$last_usr+1])){
			$last_usr++;
			$data["$last_usr"] = array(
			    "id"   => $last_usr,
				"rgb"  => $users[$last_usr]["rgb"]);
		}
		break;
	}

	usleep(MESSAGE_POLL_MICROSECONDS);
	$counter -= MESSAGE_POLL_MICROSECONDS / 1000000;
}

if(count($data)>0) {
	header('Content-Type: application/json');
	echo json_encode($data);
}






// debug : fake chat log making
// $chat = array(
// 	"1" => array(
// 		"user" => "John",
// 		"time" => time()-10,
// 		"msg"  => "Salut les copines"),
// 	"2" => array(
// 		"user" => "Lucette",
// 		"time" => time(),
// 		"msg"  => "je suis pas ta pute")
// );
// file_put_contents('chat.txt', serialize($chat));

?>
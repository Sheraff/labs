<?
	$raw = file_get_contents('09/users.txt');
	if ($raw == "")
		$users = array();
	else
		$users = unserialize($raw);
	$rgb = rand(50,255).",".rand(50,255).",".rand(50,255);
	$usr_id = array_push($users, array("rgb" => $rgb, "time" => time()));
	file_put_contents('09/users.txt', serialize($users));
?>
<style>
<?
// 	foreach ($users as $id => $data) {
// 		$id++;
// 		echo "[data-id='$id'] { color: rgb(".$data["rgb"].") }";
// 	}
// 	echo "[data-id='".($usr_id)."'] { color: rgb($rgb) }";
?>
body {
	margin: 0;
	height: 100%;
}
header {
	height: 1.5em;
}
input:first-of-type {
	width: 50vw;
}
#name {
	float: right;
}

[data-name]::before {
	content: attr(data-name)": "
}
[data-id][data-name='']::before {
	content: "guest"attr(data-id)": "
}
[data-id=''][data-name='']::before{
	content: "guest: "
}
<? echo "[data-id=$usr_id]{
	font-weight:900;
}"; ?>
main {
	height: calc(100% - 1.5em);
	width: 100vw;
	display: block;
	background-color: black;
	overflow: scroll;
	white-space: pre-line;
	padding: 0 1em;
	color: green;
	font-family: Courier New;
	font-weight: 400;
	-webkit-font-smoothing: none;
}
span {
	position: relative;
	left: 2rem;
	top: .25rem;
	transition: opacity .5s;
	opacity: 0;
}
span.loading {
	opacity: 1;
}
span::before, span::after {
	content:"";
	position: absolute;
	width: 1rem;
	height: 1rem;
	border-radius: 50%;
}
span::before {
	background-color: orange;
	box-shadow: 0 0 1px orange;
	-webkit-animation: ld3-sq1 1s linear infinite;
}
span::after {
	background-color: SteelBlue;
	box-shadow: 0 0 1px SteelBlue;
	-webkit-animation: ld3-sq2 1s linear infinite;
}
@-webkit-keyframes ld3-sq1 {
	0% {
		-webkit-transform: translateX(-150%) scale(1);
		z-index: 1;
	}
	25% {
		-webkit-transform: translateX(0) scale(1.2);
		z-index: 1;
	}
	50% {
		-webkit-transform: translateX(150%) scale(1);
		z-index: -1;
	}
	75% {
		-webkit-transform: translateX(0) scale(.8);
		z-index: -1;
	}
	100% {
		-webkit-transform: translateX(-150%) scale(1);
		z-index: -1;
	}
}
@-webkit-keyframes ld3-sq2 {
	0% {
		-webkit-transform: translateX(150%) scale(1);
		z-index: -1;
	}
	25% {
		-webkit-transform: translateX(0) scale(.8);
		z-index: -1;
	}
	50% {
		-webkit-transform: translateX(-150%) scale(1);
		z-index: -1;
	}
	75% {
		-webkit-transform: translateX(0) scale(1.2);
		z-index: 1;
	}
	100% {
		-webkit-transform: translateX(150%) scale(1);
		z-index: 1;
	}
}
</style>

<header>
	<button>Send</button>
	<input type="text" autofocus/>
	<input type="text" id="name" placeholder="pseudo" />
	<span></span>
</header>
<main>
	<?
	$last_msg = -1;
	$chat = unserialize(file_get_contents('09/chat.txt'));
	while(!is_null($chat[$last_msg+1])){
		$last_msg++;
		echo "<p class=\"msg\" data-id=\"".$chat[$last_msg]["id"]."\" data-name=".utf8_decode($chat[$last_msg]["user"]).">".htmlentities($chat[$last_msg]["msg"])."\n";
	}
	?>
</main>

<script>
window.onload = function() {
	loading_UI();
	window.setTimeout(function() {
		poll();
		done_loading_UI();
	}, 1000);
}

//////////////////
//   FRONTEND   //
//////////////////

var main = document.querySelector('main'); main.scrollTop = main.scrollHeight;
var input = document.querySelector('input');
var button = document.querySelector('button');
var loader = document.querySelector('span');
var name_input = document.querySelector('input#name');
var style = document.styleSheets[0];

function new_message(id, name, str) {
	main.innerHTML += "<p class=\"msg\" data-id=\"" + id + "\" data-name=\"" + name + "\">" + str + "\n";
	main.scrollTop = main.scrollHeight;
}

input.onkeypress = function(e) {
	if (!e) e = window.event;
	var keyCode = e.keyCode || e.which;
	if (keyCode == '13') {
		send_text();
		return false;
	}
}
button.onclick = function() {
	send_text()
}

function loading_UI() {
	loader.className = "loading";
	button.disabled = true;
	input.disabled = true;
}

function done_loading_UI() {
	loader.className = "";
	button.disabled = false;
	input.disabled = false;
	input.value = "";
	input.focus();
}



//////////////////
// LONG POLLING //
//////////////////

var last_usr = -1 ;
var last_msg = <? echo $last_msg ?>;
var usr_id = <? echo $usr_id ?>

function poll() {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			//handle result
			if (xmlhttp.responseText != "") {
				var json = JSON.parse(xmlhttp.responseText);
				if(json.type == "msg"){
					console.log("msg response")
					while (json[last_msg + 1] != null) {
						last_msg++;
						new_message(json[last_msg].id, json[last_msg].user, json[last_msg].msg)
					}
				}
				else if(json.type == "usr"){
					console.log("usr response")
					while (json[last_usr + 1] != null) {
						last_usr++;
						console.log(last_usr)
						console.log(json[last_usr].rgb)
						console.log()
						style.insertRule("[data-id='"+(last_usr+1)+"']{color:rgb("+json[""+last_usr].rgb+")}", style.cssRules.length);
					}
				}
			}

			//send next poll
			poll();
		}
	}
	console.log("polling, last_msg=" + last_msg + ", last_usr=" + last_usr);
	xmlhttp.open("POST", "09/lp.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("last_msg=" + last_msg + "&last_usr=" + last_usr);
}


//////////////////
//   BACK END   //
//////////////////

function send_text() {
	loading_UI();
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			done_loading_UI();
		}
	}
	console.log("id" + usr_id + "&user=" + name_input.value + "&msg=" + input.value);
	xmlhttp.open("POST", "09/msg.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("id=" + usr_id + "&user=" + name_input.value + "&msg=" + input.value);
}



//TO DO
function change_user_name() {

}
</script>

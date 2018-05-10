<?
$i = $_GET["id"];
$x = $_GET["x"];
$y = $_GET["y"];

$data = unserialize(file_get_contents("map.txt"));

$data[$i] = [
	"x" => $x,
	"y" => $y,
	"t" => time()
];

foreach ($data as $id => $array) {
	if(time() - $array["t"] > 10)
		unset($data[$id]);
}

echo json_encode($data);

file_put_contents("map.txt", serialize($data));
?>
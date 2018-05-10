<?
	$page = explode("/", $_SERVER[REQUEST_URI]);
	$page = end($page);

	if (strpos($page, '.') !== FALSE){
		include "./".$page;
	}
	elseif ($page!=""){
		if(strcmp("ajax-streaming-cached-metadata", $page) == 0){
			header("Location: http://movies.florianpellet.com");
			exit;
		} elseif(strcmp("osx-mockup-web-demo", $page) == 0){
			header("Location: http://sheraff.github.io/alfred-workflow-mockup/");
			exit;
		} elseif(strcmp("svg-drawn-life-graphs", $page) == 0){
			header("Location: http://whiteboard-comics.com");
			exit;
		} else{
			$page = str_replace("-", "_", $page);
			$array = glob('*.{html,php}', GLOB_BRACE);
			foreach ($array as $file) {
				$name = explode(".", explode("-", basename($file))[1])[0];
				if (strcmp($name, $page) == 0) {
					$name = ucwords(str_replace("_", " ", $name));
					echo "<title>$name</title>
	<link rel=\"icon\" type=\"image/png\" href=\"favicon.png\" />\n";
					include $file;
					break;
				}
			}
		}
	}
	else{
		include 'index.php';
	}

?>
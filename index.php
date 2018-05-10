<!doctype html>
<?
	$nonoList = ["index.php","redirect.php"];
	$array = glob('*.{html,php}', GLOB_BRACE);
	$nbOfPreviews = count($array)-count($nonoList);
	$sizeOfHeader;
	$soWeDividePageIn;
	if	  (($nbOfPreviews+2)%4==0){ $soWeDividePageIn = 4; $sizeOfHeader = 2; }
	elseif(($nbOfPreviews+1)%4==0){ $soWeDividePageIn = 4; $sizeOfHeader = 1; }
	elseif(($nbOfPreviews+2)%5==0){ $soWeDividePageIn = 5; $sizeOfHeader = 2; }
	elseif(($nbOfPreviews+3)%5==0){ $soWeDividePageIn = 5; $sizeOfHeader = 3; }
	elseif(($nbOfPreviews+1)%5==0 && $nbOfPreviews>13){ $soWeDividePageIn = 5; $sizeOfHeader = 1; }
	elseif(($nbOfPreviews+2)%6==0 && $nbOfPreviews>15){ $soWeDividePageIn = 6; $sizeOfHeader = 2; }
	elseif(($nbOfPreviews+3)%6==0 && $nbOfPreviews>14){ $soWeDividePageIn = 6; $sizeOfHeader = 3; }
	elseif(($nbOfPreviews+1)%3==0){ $soWeDividePageIn = 3; $sizeOfHeader = 1; }
	elseif(($nbOfPreviews+4)%6==0 && $nbOfPreviews>13){ $soWeDividePageIn = 6; $sizeOfHeader = 4; }
	elseif(($nbOfPreviews+3)%4==0){ $soWeDividePageIn = 4; $sizeOfHeader = 3; }
	else 						  { $soWeDividePageIn = 4; $sizeOfHeader = 2; }
	// echo "for $nbOfPreviews: we divide page in $soWeDividePageIn and get a ".$sizeOfHeader."x header\n";
?>
<link rel="icon" type="image/png" href="favicon.png" />
<title>Labs</title>
<meta name="viewport" content="width=device-width" />
<style>
body>a{
	width: <? echo 100/$soWeDividePageIn; ?>vw;
	height: <? echo 100/$soWeDividePageIn; ?>vw;
}
body>a span::after{
	word-spacing:<? echo 100/$soWeDividePageIn; ?>vw;
	line-height: <? echo 20/$soWeDividePageIn; ?>vw;
}
header{
	width: <? echo $sizeOfHeader * 100/$soWeDividePageIn; ?>vw;
	height: <? echo floor(100/$soWeDividePageIn); ?>vw;
}
</style>
<link rel="stylesheet" href="s.css">
<footer>
	<a href="mailto:f-p-e-l-l-e-t-@-e-n-s-c-.-f-r" target="_blank">email</a> -
	<a href="http://florianpellet.com/Florian_Pellet_CV.pdf" target="_blank">CV</a> -
	<a href="http://florianpellet.com">florianpellet.com</a>
</footer>
<header<? if( ($sizeOfHeader==1 && ($soWeDividePageIn==5 || $soWeDividePageIn==4)) || $soWeDividePageIn==6) echo " class=\"small\""; ?>>
	<h1>Labs</h1>
	<span>by <a>Florian</a></span>
</header>
<?
	sort($array);
	foreach(array_reverse($array) as $file) {
		if(!in_array(basename($file),$nonoList)){
			$link = basename($file);
			$img = explode("-", $link)[0];
			$name = str_replace("_", " ", explode(".", explode("-", $link)[1])[0]);
			$rewrite = str_replace(" ", "-", $name);
			echo
<<< HTML
<a href="$rewrite">
	<div class="bg" style="background-image:url(icns/$img.jpg)"></div>
	<span data-text="$name"></span>
</a>\n
HTML;
		}
	}

?>
<script>
	var toggle = true;
	document.onclick = function () {
		document.body.className = ""
	}
	document.querySelector('header a').onclick = function (e) {
		if(toggle) document.body.className = "low";
		else document.body.className = "";
		toggle = !toggle; e.stopPropagation()
	}

	var mail = document.getElementsByTagName('footer')[0].getElementsByTagName('a')[0];
	mail.setAttribute("href", mail.getAttribute("href").replace(/-/g, ""));
</script>

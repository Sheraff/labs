<?
	$images = glob('13/img/*.{png}', GLOB_BRACE);
	$picture_size = 410;
	$timing = ((count($images)-2)*.1)."s";
	$steps = count($images)-1;
	$translate = (count($images)*$picture_size)."px";
	$picture_size_css = $picture_size."px";
?>
<!DOCTYPE html>
<meta charset="utf-8">
<title>Zoetrope</title>
<link rel="stylesheet" href="13/s.css">
<?
echo <<< HERE
<style type="text/css">
body>div{
	width: $picture_size_css;
}

body.zeo .strip{
	-webkit-animation-timing-function: steps($steps, end);
	-moz-animation-timing-function: steps($steps, end);
	-o-animation-timing-function: steps($steps, end);
	animation-timing-function: steps($steps, end);
}
.animate .strip{
	-webkit-animation: scroll $timing infinite;
	-moz-animation: scroll $timing infinite;
	-o-animation: scroll $timing infinite;
	animation: scroll $timing infinite;
}
@-webkit-keyframes scroll {
	to { -webkit-transform: translateX(-$translate); }
}
@-moz-keyframes scroll {
	to { -moz-transform: translateX(-$translate); }
}
@-o-keyframes scroll {
	to { -o-transform: translateX(-$translate); }
}
@keyframes scroll {
	to { transform: translateX(-$translate); }
}

img{
	width: $picture_size_css;
}
</style>
HERE;
?>
<p>click image strip to toggle the zoetrope</p>

<div class="animate">
	<div class="strip">
	<?
		foreach($images as $file) {
			// rename($file, str_replace(" ", "_", $file));
			echo "<img src=\"13/img/".basename($file)."\">\n";
		}
	?>
	</div>
</div>

<audio controls autoplay loop muted>
  <source src="13/mm.ogg" type="audio/ogg">
  <source src="13/mm.mp3" type="audio/mpeg">
</audio>

<script src="13/s.js"></script>
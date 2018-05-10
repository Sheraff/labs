<!DOCTYPE html>
<style>
	#templates{
		display: none;
	}
	svg{
		float: left;
		min-width: 20px
	}
	line, path{
		fill:none;
		stroke-width:10;
		stroke-linecap:round;
		stroke:#000000;
		stroke-linejoin:round;
	}
	.space{
		width: 20px;
		height: 40px;
		float: left;
	}
</style>
<div id="templates">
	<?php
		foreach(array_reverse(glob('02/*.{svg}', GLOB_BRACE)) as $file) {
			echo "<div id=\"".explode(".",basename($file))[0]."\">\n";
			include($file);
			echo "\n</div>\n";
		}
	?>
	<div id=" ">
		<span class="space"></span>
	</div>
</div>
<span id="text">cosby sweater irony stumptown PBR seitan. Terry Richardson aesthetic small batch chia, wayfarers Carles biodiesel flannel. Echo Park selvage retro, blog nineties letterpress Thundercats. Narwhal Echo Park Odd Future, Intelligentsia cornhole master cleanse nineties pug Truffaut kale chips.</span>
<script>

	//replace
	console.log("replace");
	var span = document.getElementById('text');
	var text = span.innerHTML;
	var replacement = "";
	for (var i = 0; i < text.length; i++) {
		//console.log(text[i]);
		if (text[i]==".")
			replacement += document.getElementById("dot").innerHTML;
		else{
		// if(text[i] == text[i].toUpperCase() && text[i].toUpperCase() != text[i].toLowerCase())
		// 	span.innerHTML += document.getElementById(text[i]+"up").innerHTML;
		// else
			replacement += document.getElementById(text[i].toLowerCase()).innerHTML;
		}
	};
	span.innerHTML = replacement;

	//set width & height
	console.log("set size");
	var svgs = span.getElementsByTagName('svg');
	for (var j = 0; j < svgs.length; j++) {
		var size = svgs[j].getAttribute("viewBox").split(" ");
		svgs[j].style.width = (size[2]-10)+"px";
		svgs[j].style.height = (size[3]-10)+"px";
	}

	//set anim
	console.log("set anim");
	var paths = document.getElementsByTagName('path');
	function init_paths(){
		for (var j = 0; j < paths.length; j++) {
			var pathLength = paths[j].getTotalLength();
			var begin = "";
			if (j!=0) begin = "begin=\"animation"+(j-1)+".end+"+(Math.random()/4+0.05)+"s\"";
			var dur = (pathLength/((Math.random()+0.8)*150));
			var animation = "<animate id=\"animation"+j+"\" attributeName=\"stroke-dashoffset\" from=\"0\" to=\"0\" dur=\""+dur+"s\" "+begin+" fill=\"freeze\" keySplines=\""+(Math.random()/2)+" "+(Math.random())+" "+Math.random()+" "+(Math.random()/2)+"\"  calcMode=\"spline\"/>";
			paths[j].innerHTML = animation;
		}
	}
	init_paths();

	console.log("launch");
	function launch() {
		for (var j = 0; j < paths.length; j++) {
			path=paths[j];
			pathLength=path.getTotalLength().toString();
			pathAnim=path.getElementsByTagName('animate')[0];
			path.setAttributeNS(null,'stroke-dasharray',pathLength+" "+pathLength);
			path.setAttributeNS(null,'stroke-dashoffset',pathLength);
			pathAnim.setAttributeNS(null,'from',pathLength);
			pathAnim.setAttributeNS(null,'values',pathLength+';0');
		}
	}
	launch();
</script>
window.onload = function() {
	console.log("coucou");
	document.getElementsByTagName('div')[0].onclick = function () {
		this.className = "";

		if(document.body.className == "zeo")
			document.body.className = ""
		else
			document.body.className = "zeo";

		window.setTimeout(function () {
			document.getElementsByTagName('div')[0].className = "animate";
		},1);
	}
}
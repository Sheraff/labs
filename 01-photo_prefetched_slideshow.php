<title>who are they</title>
<style>
	*,
	*::after {
	  margin: 0;
	  padding: 0;
	  box-sizing: border-box;
	}
	body {
	  width: 100%;
	  height: 100%;
	  background-color: black;
	  font-family: "Helvetica Neue", "HelveticaNeue", "Arial", sans-serif;
	  font-weight: 100;
	}
	.animate {
	  transition: all 0.2s ease-out;
	}
	div {
	  display: block;
	  width: 50%;
	  height: 100%;
	  position: fixed;
	  background-position: 50%;
	  background-size: cover;
	  background-repeat: no-repeat;
	}
	article {
	  display: block;
	  width: 50%;
	  float: right;
	  padding: 5vw;
	  color: white;
	}
	article p {
	  margin-bottom: 2rem;
	  letter-spacing: 1px;
	}
	menu {
	  position: fixed;
	  z-index: 99;
	  top: 0;
	  width: 100%;
	  height: 10rem;
	  color: white;
	  transition: all 0.2s ease-out;
	}
	menu.loading label {
	  -webkit-animation: spin_w 2s linear infinite;
	  animation: spin 2s linear infinite;
	}
	@-webkit-keyframes spin_w {
	  from {
		-webkit-transform: scale(1.4) rotate(-30deg);
	  }
	  to {
		-webkit-transform: scale(1.4) rotate(329deg);
	  }
	}
	@keyframes spin {
	  from {
		transform: scale(1.4) rotate(-30deg);
	  }
	  to {
		transform: scale(1.4) rotate(329deg);
	  }
	}
	label {
	  position: absolute;
	  right: 0;
	  top: -0.5rem;
	  z-index: 1;
	  display: block;
	  width: 10rem;
	  text-align: center;
	  font-size: 3rem;
	  -webkit-transform: scale(1.4) rotate(-30deg);
	  line-height: 10rem;
	  -webkit-transform-origin: 5rem 5.5rem;
	  cursor: pointer;
	  text-shadow: 0 0 1rem #4D7480;
	  transition: all 0.2s ease-out;
	}
	label:hover {
	  text-shadow: 0 0 1rem white;
	}
	ul {
	  position: absolute;
	  width: 100vw;
	  height: 10rem;
	  background-color: #4d7480;
	  padding-right: 10rem;
	  display: -webkit-flex;
	  display: flex;
	  list-style: none;
	  transition: all 0.2s ease-out;
	}
	menu:not(:hover) {
	  height: 4rem;
	}
	menu:not(:hover) label {
	  width: 4rem;
	  line-height: 4rem;
	  -webkit-transform-origin: 2rem 2.5rem;
	}
	menu:not(:hover) ul {
	  height: 4rem;
	  padding-right: 10rem;
	  opacity: 0;
	  -webkit-transform: translateY(-100%);
	}
	a {
	  color: inherit;
	}
	li {
	  margin: auto;
	  -webkit-flex: 1;
	  flex: 1;
	  text-align: center;
	}
	li [data-mail]::after {
	  content: attr(data-mail);
	}
	.p {
	  text-align: right;
	  -webkit-flex: none;
	  flex: none;
	  letter-spacing: 1px;
	}
	.img {
	  -webkit-flex: none;
	  flex: none;
	  width: 10rem;
	}
	.img p {
	  padding: 1rem;
	}
	img {
	  width: 8rem;
	  margin: 0 1rem;
	}
	@media screen and (orientation: portrait) {
	  .p {
		display: none;
	  }
	  div {
		width: 100%;
	  }
	  article {
		width: 100%;
		position: relative;
		bottom: 0;
		z-index: 0;
		background-color: rgba(0, 0, 0, 0.5);
	  }
	}

</style>
<div></div>
<div></div>
<menu>
	<label for="menu-roller">&there4;</label>
	<ul>
		<li><h1>who are they</h1><p data-mail="fpellet@ensc.fr"></li>
	</ul>
</menu>
<article>
	<p>who are they?
	<p>like everyone at some point, i've come to the realization that people all look beautiful in their own way &mdash; but what we tend to ignore is how ordinary, irresponsible and mean we all are too
	<p>when i see a face, i see features that i know. that nose i've seen before. this twitch on the cheek, an old lady in the subway had the same yesterday. a common chin, and a very standard expression. we're only different in that we're made of the same pieces assembled differently
	<p>but personalities are the same. this person greets me with the same expression my dad has. that one says the same thing every time he let's someone in the bus first &mdash; the same thing so many people say. and it goes deeper, to the way you tell jokes, how you touch a hand for the first time, this thing you do when you look for eye contact. i've all seen it before. what is only yours? are you just a patchwork of other people?
	<p>if you are your own person, why are you so mean to others? why do you get annoyed when she wakes you up at night because she can't sleep? why do you make this kid feel stupid when he asks a question? why don't you help that lady with the huge suitcase? why do you consume products that destroy lives? do you do all that because these are socially accepted actions? is the reason that these are not YOUR behaviors, but behaviors you're just borrowing from society? but then what is yours?
	<p>who are you?
</article>
<script>
	var maxIndex = <? echo count(glob('01/*.{jpg}', GLOB_BRACE)); ?>;
	var index;

	//init
	var imageLoader = new Image(), imageLoader2 = new Image(), imageDoneLoading = false;
	imageLoader.onload = tryToStart;
	imageLoader2.onload = tryToStart;
	imageLoader.src = "01/"+(Math.floor(Math.random() * maxIndex) + 1)+".jpg";
	imageLoader2.src = "01/"+(Math.floor(Math.random() * maxIndex) + 1)+".jpg";
	document.getElementsByTagName('menu')[0].className = "loading";
	function tryToStart(){
		if(imageDoneLoading){
			document.getElementsByTagName('menu')[0].className = "";
			divs[1].style.backgroundImage = "url("+imageLoader2.src+")";
			divs[0].style.backgroundImage = "url("+imageLoader.src+")";
			initPics();
		}
		else
			imageDoneLoading = true;
	}

	//recurrent
	var divs = document.getElementsByTagName('div');
	function initPics(){
		divs[0].style.opacity = 1;
		divs[1].style.opacity = 1;
		startTransition ();
		loadNextImage ();
	}

	var opacityTransitionFinished, opacityTransition;
	function startTransition () {
		opacityTransitionFinished = false;
		opacityTransition = window.setInterval(function () {
			divs[1].style.opacity -= .001;
			if(divs[1].style.opacity<=.001){
				clearInterval(opacityTransition);
				opacityTransitionFinished = true;
				tryToSwitch();
			}
		},16);
	}

	var imageLoader, imageDoneLoading, index;
	function loadNextImage () {
		imageLoader = new Image();
		imageDoneLoading = false;
		imageLoader.onload = function () {
			imageDoneLoading = true;
			tryToSwitch();
		}
		var temp = index;
		do
			index = (Math.floor(Math.random() * maxIndex) + 1);
		while (index==temp);
		imageLoader.src = "01/"+index+".jpg";
	}

	function tryToSwitch () {
		if(imageDoneLoading && opacityTransitionFinished){
			document.getElementsByTagName('menu')[0].className = "";
			var temp = divs[0].style.backgroundImage;
			divs[0].style.backgroundImage = "url("+imageLoader.src+")";
			divs[1].style.backgroundImage = temp;
			initPics();
		}
		else if(opacityTransitionFinished)
			document.getElementsByTagName('menu')[0].className = "loading";
	}

	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-48302831-4', 'florianpellet.com');
	  ga('send', 'pageview');
</script>

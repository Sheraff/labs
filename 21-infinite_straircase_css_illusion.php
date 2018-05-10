<style>
	*{
		margin: 0;
		padding: 0;
	}
	html{
		font-size: 10px;
	}
	body{
		background-color: #D9EEFF;
		font-size: 40px;
	}
	div{
		/* positionning */
		position: absolute;
		left: 50%;
		top: 0;

		/* properties */
		height: 3em;
		width: 3em;

		transform-style: preserve-3d;
		transform: translate3d(-50%, 0, 0) rotateX(55.6deg) rotateY(0deg) rotateZ(45deg);
	}
	div>span{
		/* positionning */
		position: absolute;
		left: 0;
		top: 0;

		/* properties */
		display: block;
		width: 100%;
		height: 100%;

		/* styling */
		box-shadow: 0 0 1em rgba(0, 0, 0, .1), inset 0 0 .1em rgba(0, 0, 0, .2);

		background-color: white;

		font-size: 2em;
		line-height: 1.5em;
		text-align: center;
		color: transparent;
	}

	div::after, div::before{
		/* formatting */
		content: ' ';

		/* positionning */
		position: absolute;
		right: 0;
		bottom: 0;

		/* properties */
		display: block;
		width: 100%;
		height: 100%;
	}
	div::before{
		z-index: 4;
		transform-origin: 100% 50% 0;
		transform: rotateY( 90deg ) translateX( 100% );
		background-color: #DDDDDD;
		width: 100%;
		/*animation-name: unfold-rht;*/
	}
	div::after{
		z-index: 3;
		transform-origin: 50% 100% 0;
		transform: rotateX( -90deg ) translateY( 100% );
		background-color: #EEEEEE;
		height: 100%;
		/*animation-name: unfold-lft;*/
	}

div:nth-child(1){ left: 0em;  top: 0em; 	 z-index: 1; }
div:nth-child(2){ left: 2em;  top: .75em;  z-index: 2; }
div:nth-child(3){ left: 4em;  top: 1.5em;  z-index: 3; }
div:nth-child(4){ left: 6em;  top: 2.25em; z-index: 4; }
div:nth-child(5){ left: 8em; top: 3em;		 z-index: 5; }
div:nth-child(6){ left: 2em; top: -.75em;		 z-index: -10; }
div:nth-child(7){ left: 4em;  top: -1.5em;  z-index: -11; }
div:nth-child(8){ left: 6em;  top: -2.25em; z-index: -12; }
div:nth-child(9){ left: 8em; top: -3em;		 z-index: -13; }
div:nth-child(10){ left: 10.1em; top: -1.5em;		 z-index: -12; }
div:nth-child(11){ left: 12.2em; top: -0em;		 z-index: -11; }
div:nth-child(12){ left: 10.1em; top: 1.5em;		 z-index: -10; }

div:nth-child(1)::after{ height: 200%; }
div:nth-child(2)::after{ height: 215%; }
div:nth-child(3)::after{ height: 230%; }
div:nth-child(4)::after{ height: 245%; }
div:nth-child(5)::after{ height: 260%; }
div:nth-child(6)::after{ height: 185%; }
div:nth-child(7)::after{ height: 170%; }
div:nth-child(8)::after{ height: 170%; }
div:nth-child(9)::after{ height: 170%; }
div:nth-child(10)::after{ height: 170%; }
div:nth-child(11)::after{ height: 287%; }
div:nth-child(12)::after{ height: 273%; }

div:nth-child(1)::before{ width: 200%; }
div:nth-child(2)::before{ width: 215%; }
div:nth-child(3)::before{ width: 230%; }
div:nth-child(4)::before{ width: 245%; }
div:nth-child(5)::before{ width: 260%; }
div:nth-child(6)::before{ width: 185%; }
div:nth-child(7)::before{ width: 170%; }
div:nth-child(8)::before{ width: 170%; }
div:nth-child(9)::before{ width: 170%; }
div:nth-child(10)::before{ width: 170%; }
div:nth-child(11)::before{ width: 287%; }
div:nth-child(12)::before{ width: 273%; }

#container{
	position: relative;
	left: 50%;
	top: 50%;
	transform: translate(-50%, -50%);
	height: 9em;
	width: 13em;
}
	

</style>
<section id="container">
	<div><span>5</span></div>
	<div><span>4</span></div>
	<div><span>3</span></div>
	<div><span>2</span></div>
	<div><span>1</span></div>
	<div><span>6</span></div>
	<div><span>7</span></div>
	<div><span>8</span></div>
	<div><span>9</span></div>
	<div><span>10</span></div>
	<div><span>11</span></div>
	<div><span>12</span></div>
</section>
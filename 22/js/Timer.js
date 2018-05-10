export default class Timer{
	constructor(fps = 1000/60){
		this.fps = fps
		this.lastTime = 0
		this.deltaTime = 0
	}

	updateLoop(time) {
		time -= this.firstTime
		this.deltaTime += time - this.lastTime
		while(this.deltaTime > this.fps){
			this.update(this.fps)
			this.deltaTime -= this.fps
		}
		this.lastTime = time
		this.queue()
	}

	update(){
		console.warn('no update command on Timer')
	}

	queue(){
		requestAnimationFrame(this.updateLoop.bind(this))
	}

	start(){
		this.firstTime = performance.now()
		this.queue()
	}
}

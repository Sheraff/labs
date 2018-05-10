import Camera from './Camera.js'
import Timer from './Timer.js'
import {loadLevel} from './loaders.js'
import {createMario} from './entities.js'
import {createCollisionLayer, createCameraLayer} from './layers.js'
import {setupKeyboard} from './input.js'

export const ROOT = '22'
const CANVAS = canvas
const CONTEXT = CANVAS.getContext('2d')

Promise.all([
		createMario(),
		loadLevel('1-1')
	])
	.then(([mario, level]) => {

		const camera = new Camera()

		mario.pos.set(64, 64)
		level.entities.add(mario)

		// collision boxes for DEBUG pusposes (as well as within the `timer.update` function)
		// level.comp.layers.push(
		// 	createCollisionLayer(level),
		// 	createCameraLayer(camera))

		const keys = setupKeyboard(mario)
		const timer = new Timer()
		timer.update = function(𝛥t){
			level.comp.draw(CONTEXT, camera)
			level.update(𝛥t)
			if(mario.pos.x - camera.pos.x > 1/2 * CANVAS.width)
				camera.pos.x = - 1/2 * CANVAS.width + mario.pos.x
			else if(mario.pos.x - camera.pos.x < 1/5 * CANVAS.width)
				camera.pos.x = - 1/5 * CANVAS.width + mario.pos.x
		}

		timer.start()

	})

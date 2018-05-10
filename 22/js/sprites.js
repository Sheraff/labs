import Spritesheet from './Spritesheet.js'
import {loadImage} from './loaders.js'
import {ROOT} from './main.js'

export function loadMotionSprite() {
	return loadImage('characters.gif')
		.then(img => {
			const sprite = new Spritesheet(img, 16, 16)
			sprite.preciseDefine('idle', 276, 44, 16, 16)
			return sprite
		})
}

import Entity from './Entity.js'
import * as Traits from './traits.js'
import {loadMotionSprite} from './sprites.js'


export function createMario (){
	return loadMotionSprite()
	.then(sprite => {

		const mario = new Entity()
		mario.size.set(14, 16)

		mario.addTrait(new Traits.Go())
		mario.addTrait(new Traits.Jump())
		// mario.addTrait(new Traits.Velocity())

		mario.draw = function drawMario(context){
			sprite.preciseDrawTile('idle', context, 0, 0)
		}

		return mario
	})
}

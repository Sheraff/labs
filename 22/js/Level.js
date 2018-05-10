import Compositor from './Compositor.js'
import {Matrix} from './math.js'
import TileCollider from './TileCollider.js'

export default class Level{
	constructor(){
		this.comp = new Compositor()
		this.entities = new Set()
		this.terrain = new Matrix()
		this.gravity = 3

		this.tileCollider = new TileCollider(this.terrain)
	}
	update(𝛥t){
		this.entities.forEach(entity => {
			entity.update(𝛥t)

			entity.pos.x += entity.vel.x * 𝛥t / 1000
			this.tileCollider.checkX(entity)

			entity.pos.y += entity.vel.y * 𝛥t / 1000
			this.tileCollider.checkY(entity)

			entity.vel.y += this.gravity * 𝛥t

			//not going through walls with sheer speed
			entity.vel.y = Math.min(entity.vel.y, 1250)
			entity.vel.x = Math.min(entity.vel.x, 1250)
		})
	}
}

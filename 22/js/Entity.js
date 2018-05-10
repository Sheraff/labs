import {Vec2} from './math.js'

export class Trait {
	constructor(name) {
		this.NAME = name
	}

	update() {
		console.warn(this.NAME, 'trait `update()` not defined')
	}
}

export default class Entity {
	constructor(){
		this.pos = new Vec2()
		this.vel = new Vec2()
		this.size = new Vec2()

		this.traits = []
	}

	addTrait(trait) {
		this.traits.push(trait)
		this[trait.NAME] = trait
	}

	update(𝛥t){
		this.traits.forEach(trait => {
			trait.update(this, 𝛥t)
		})
	}
}

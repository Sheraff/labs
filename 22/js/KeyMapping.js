 const PRESSED = Symbol('PRESSED')
 const RELEASED = Symbol('RELEASED')

export default class KeyMapping {
	constructor(target){
		this.keyCalls = new Map()
		this.keyStates = new Map()

		target.addEventListener('keydown', this.handle.bind(this))
		target.addEventListener('keyup', this.handle.bind(this))
	}

	getState(key){
		return this.keyStates.get(key) === PRESSED
	}

	add(key, callback){
		this.keyStates.set(key, RELEASED)
		this.keyCalls.set(key, callback)
	}

	handle(event){
		if(!this.keyStates.get(event.key))
			return true
		event.preventDefault()

		switch (event.type) {
			case 'keyup':
				if(this.keyStates.get(event.key) === RELEASED)
					break;
				this.keyStates.set(event.key, RELEASED)
				this.keyCalls.get(event.key)(false)
				break;
			case 'keydown':
				if(this.keyStates.get(event.key) === PRESSED)
					break;
				this.keyStates.set(event.key, PRESSED)
				this.keyCalls.get(event.key)(true)
				break;
		}

		return false
	}
}

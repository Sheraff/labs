export class Matrix {
	constructor() {
		this.matrix = []
	}
	get(x, y){
		return (typeof this.matrix[x] === 'undefined') ? undefined : this.matrix[x][y]
	}
	set(x, y, value){
		if (!this.matrix[x])
			this.matrix[x] = []

		this.matrix[x][y] = value
	}
	forEach(callback){
		this.matrix.forEach((column, x) => {
			column.forEach((value, y) => {
				callback(value, x, y)
			})
		})
	}
}

export class Vec2 {
	constructor(x = 0, y = 0){
		this.set(x, y)
	}
	set(x, y){
		this.x = x
		this.y = y
	}
}

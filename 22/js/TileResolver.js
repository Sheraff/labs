export default class TileResolver{
	constructor(matrix, tileSize = 16){
		this.matrix = matrix
		this.tileSize = tileSize
	}
	toIndex(pos){
		return Math.floor(pos / this.tileSize)
	}
	toIndexRange(pos1, pos2){
		const pMax = Math.ceil(Math.max(pos1, pos2) / this.tileSize) * this.tileSize 
		const range = []
		let pos = Math.min(pos1, pos2)
		do{
			range.push(this.toIndex(pos))
			pos += this.tileSize
		} while (pos < pMax)
		return range
	}
	getByIndex(x, y){
		const match = this.matrix.get(x, y)
		if(match) return {
			y1: y * this.tileSize,
			y2: y * this.tileSize + this.tileSize,
			x1: x * this.tileSize,
			x2: x * this.tileSize + this.tileSize,
			tile: match
		}
	}
	searchByPosition(x, y){
		return this.getByIndex(this.toIndex(x), this.toIndex(y))
	}
	searchByPositionRange(x1, y1, x2, y2){
		const indexes = []
		this.toIndexRange(x1, x2).forEach(x => {
			this.toIndexRange(y1, y2).forEach(y => {
				const match = this.getByIndex(x, y)
				if(match) indexes.push(match)
			})
		})
		return indexes
	}
}

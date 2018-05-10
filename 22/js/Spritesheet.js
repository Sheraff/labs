export default class SpriteSheet {
	constructor(img, tileWidth, tileHeight) {
		this.img = img
		this.tileWidth = tileWidth
		this.tileHeight = tileHeight
		this.tiles = new Map()
	}
	preciseDefine(sprite, x, y, dx, dy) {
		let canvas = document.createElement('canvas')
		canvas
			.getContext('2d')
			.drawImage(
				this.img,
				x, y, dx, dy,
				0, 0, dx, dy
			)
		this.tiles.set(sprite, canvas)
	}
	define(sprite, x, y) {
		this.preciseDefine(sprite, x * this.tileWidth, y * this.tileHeight, this.tileWidth, this.tileHeight)
	}
	preciseDrawTile(sprite, context, x, y) {
		context.drawImage(
			this.tiles.get(sprite),
			0, 0, this.tileWidth, this.tileHeight,
			x, y, this.tileWidth, this.tileHeight
		)
	}
	drawTile(sprite, context, x, y) {
		this.preciseDrawTile(sprite, context, x * this.tileWidth, y * this.tileHeight)
	}
}

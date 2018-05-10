export function createTerrainLayer(level, sprite, width = 256, height = 240){
	const bufferCanvas = document.createElement('canvas')
	bufferCanvas.width = width + 16
	bufferCanvas.height = height
	const bufferContext = bufferCanvas.getContext('2d')
	const tileResolver = level.tileCollider.tiles

	let prevStartIndex, prevEndIndex
	function redraw(startIndex, endIndex){
		if(startIndex===prevStartIndex && endIndex===prevEndIndex)
			return
		prevStartIndex = startIndex
		prevEndIndex = endIndex
		for(let x = startIndex; x <= endIndex; x++){
			if(level.terrain.matrix[x])
				level.terrain.matrix[x].forEach((tile, y) => {
					sprite.drawTile(tile.sprite, bufferContext, x - startIndex, y)
				})
		}
	}

	return function drawTerrainLayer(context, camera){
		const xRange = tileResolver.toIndexRange(camera.pos.x, camera.pos.x + camera.size.x)
		redraw(xRange.shift(), xRange.pop())
		context.drawImage(bufferCanvas, -camera.pos.x % 16, -camera.pos.y)
	}
}

export function createMotionLayer(entities, width = 64, height = 64){
	const bufferCanvas = document.createElement('canvas')
	bufferCanvas.width = width
	bufferCanvas.height = height
	const bufferContext = bufferCanvas.getContext('2d')
	return function drawMotionLayer(context, camera){
		entities.forEach(entity => {
			// entity.draw(context, entity.pos.x - camera.pos.x, entity.pos.y - camera.pos.y)
			bufferContext.clearRect(0, 0, bufferCanvas.width, bufferCanvas.height)
			entity.draw(bufferContext)
			context.drawImage(bufferCanvas, entity.pos.x - camera.pos.x, entity.pos.y - camera.pos.y)
		})
	}
}

export function createCameraLayer(camera){
	return function drawCameraRect(context, fromCamera) {
		context.strokeStyle = 'purple'
		context.beginPath()
		context.rect(
			camera.pos.x - fromCamera.pos.x,
			camera.pos.y - fromCamera.pos.y,
			camera.size.x,
			camera.size.y
		)
		context.stroke()
	}
}

export function createCollisionLayer(level){
	const resolvedTiles = []

	const tileResolver = level.tileCollider.tiles
	const tileSize = tileResolver.tileSize

	const getByIndexOriginal = tileResolver.getByIndex
	tileResolver.getByIndex = function getByIndexFake(x, y) {
		resolvedTiles.push({x, y})
		return getByIndexOriginal.call(tileResolver, x, y)
	}

	return function drawCollision(context, camera){
		context.strokeStyle = 'blue'
		resolvedTiles.forEach(({x, y}) => {
			context.beginPath()
			// context.rect(x*tileSize, y*tileSize, tileSize, tileSize)
			context.rect(x*tileSize - camera.pos.x, y*tileSize - camera.pos.y, tileSize, tileSize)
			context.stroke()
		})

		level.entities.forEach(entity => {
			context.strokeStyle = 'red'
			context.beginPath()
			context.rect(
				entity.pos.x - camera.pos.x,
				entity.pos.y - camera.pos.y,
				entity.size.x,
				entity.size.y)
			context.stroke()
		})

		resolvedTiles.length = 0
	}
}

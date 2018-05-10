import Level from './Level.js'
import Spritesheet from './Spritesheet.js'
import {createTerrainLayer, createMotionLayer} from './layers.js'
import {ROOT} from './main.js'

export function loadImage(src){
	return new Promise(resolve => {
		var img = new Image()
		img.addEventListener('load', () => {
			resolve(img)
		})
		img.src = `${ROOT}/img/${src}`
	})
}

export function loadJson(src){
	return fetch(src)
		.then(file => file.json())
}

export function loadSpritesheet(name){
	return loadJson(`${ROOT}/sprites/${name}.json`)
	.then(spriteSpecs => {
		return loadImage(spriteSpecs.src)
		.then(img => {
			const sprite = new Spritesheet(img, spriteSpecs.tileWidth, spriteSpecs.tileHeight)
			spriteSpecs.tiles.forEach(tile => {
				sprite.define(tile.name, ...tile.indexes)
			})
			return sprite
		})
	})
}

function createTiles(level, terrain){
	terrain.forEach(tileSet => {
		tileSet.ranges.forEach((range) => {
			let xStart, xLength, yStart, yLength
			if(range.length===2)
				[xStart, xLength, yStart, yLength] = [range[0], 1, range[1], 1]
			else if(range.length===3)
				[xStart, xLength, yStart, yLength] = [range[0], range[1], range[2], 1]
			else if(range.length===4)
				[xStart, xLength, yStart, yLength] = range
			for (let x = 0; x < xLength; x++) {
				for (let y = 0; y < yLength; y++) {
					level.terrain.set(xStart + x, yStart + y, {
						sprite: tileSet.sprite,
						type: tileSet.type
					})
				}
			}
		})
	})
}

export function loadLevel(level){
	return Promise.all([
			loadSpritesheet('overworld'),
			loadJson(`${ROOT}/levels/${level}.json`)
		])
		.then(([terrainSprite, specs]) => {
			const level = new Level()

			createTiles(level, specs.terrain)

			level.comp.layers.push(createTerrainLayer(level, terrainSprite))
			level.comp.layers.push(createMotionLayer(level.entities))

			return level
		})
}

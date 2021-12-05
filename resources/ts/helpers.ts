import { IMAGE_DIMENSIONS_PLACEHOLDER, IMAGE_THUMBNAIL_DIMENSIONS } from "resources/ts/constants";

export const setImageSize = (url: string, width? : number, height?: number): string => {
  return url.replace(IMAGE_DIMENSIONS_PLACEHOLDER, `${width ? width : 150}x${height ? height : ''}`)
}
 
export const getImagePlaceholderPath = (): string => {
  return '/build/media/default-image.jpg' //TODO resize it, it's way too big for a thumbnail
}

export const thumbnail = (url: string, dimensions: string = IMAGE_THUMBNAIL_DIMENSIONS): string => {
  console.log(IMAGE_DIMENSIONS_PLACEHOLDER)
  console.log(url.replace(IMAGE_DIMENSIONS_PLACEHOLDER, dimensions))
  return url.replace(IMAGE_DIMENSIONS_PLACEHOLDER, dimensions)
}
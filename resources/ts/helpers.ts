export const setImageSize = (url: string, width? : number, height?: number): string => {
  return url.replace("{widthxheight}", `${width ? width : 150}x${height ? height : ''}`)
}

export const getImagePlaceholderPath = (): string => {
  return '/build/media/default-image.jpg' //TODO resize it, it's way too big for a thumbnail
}
export const setImageSize = (url: string, width: number = 150, height:number): string => {
  return url.replace("{widthxheight}", `${width}x${height ? height : ''}`)
}

export const getImagePlaceholderPath = (): string => {
  return '/build/media/default-image.jpg'
}
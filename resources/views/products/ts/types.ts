export interface FileInterface {
  id: string, //uuid
  fullRealName: string,
  mimeType: string,
  url: string,
  size: number,
}

export interface ProductFileInterface {
  file: FileInterface,
  position: number | null
}
export interface File {
  id: string, //uuid
  fullRealName: string,
  mimeType: string,
  url: string,
  size: number,
}

export interface ProductFile {
  file: File,
  position: number | null
}
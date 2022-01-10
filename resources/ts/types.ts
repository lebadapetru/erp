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

export interface AlertInterface {
  title: string,
  text?: string,
}

export interface ToastInterface extends AlertInterface {

}

export interface PopupInterface extends AlertInterface {
  confirmButtonText?: string
}

export interface TableColumnInterface {
  name: string,
  key: string,
  width?: number,
  fieldParser: (any) => any,
}
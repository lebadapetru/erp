export interface AlertInterface {
  title: string,
  text?: string,
}

export interface ToastInterface extends AlertInterface {

}

export interface PopupInterface extends AlertInterface {
  confirmButtonText?: string
}
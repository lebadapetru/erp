import Swal from "sweetalert2";
import {
  ALERT_ICON_ERROR,
  ALERT_ICON_INFO,
  ALERT_ICON_SUCCESS,
  ALERT_ICON_WARNING
} from "resources/components/alerts/constants";
import { PopupInterface } from "resources/ts/types";

export const PopupMixin = Swal.mixin({
  showCancelButton: true,
  buttonsStyling: false,
  cancelButtonColor: '#d33',
  confirmButtonColor: '#3085d6',
  customClass: {
    confirmButton: "btn font-weight-bold btn-light-primary",
    cancelButton: "btn font-weight-bold btn-light-primary",
  },
  heightAuto: false
})

export const Popup = {
  success: ({ title, text, confirmButtonText }: PopupInterface) => PopupMixin.fire({
    icon: ALERT_ICON_SUCCESS,
    title,
    text,
    confirmButtonText
  }),
  error: ({ title, text, confirmButtonText }: PopupInterface) => PopupMixin.fire({
    icon: ALERT_ICON_ERROR,
    title,
    text,
    confirmButtonText
  }),
  warning: ({ title, text, confirmButtonText }: PopupInterface) => PopupMixin.fire({
    icon: ALERT_ICON_WARNING,
    title,
    text,
    confirmButtonText
  }),
  info: ({ title, text, confirmButtonText }: PopupInterface) => PopupMixin.fire({
    icon: ALERT_ICON_INFO,
    title,
    text,
    confirmButtonText
  }),
}
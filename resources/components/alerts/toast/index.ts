import Swal from "sweetalert2";
import {
  ALERT_ICON_ERROR,
  ALERT_ICON_INFO,
  ALERT_ICON_SUCCESS,
  ALERT_ICON_WARNING
} from "resources/components/alerts/constants";
import { ToastInterface } from "resources/ts/types";

export const ToastMixin = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000,
  timerProgressBar: true,
  showCloseButton: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  },
})

export const Toast = {
  success: ({ title, text }: ToastInterface) => ToastMixin.fire({
    icon: ALERT_ICON_SUCCESS,
    title,
    text
  }),
  error: ({ title, text }: ToastInterface) => ToastMixin.fire({
    icon: ALERT_ICON_ERROR,
    title,
    text
  }),
  warning: ({ title, text }: ToastInterface) => ToastMixin.fire({
    icon: ALERT_ICON_WARNING,
    title,
    text
  }),
  info: ({ title, text }: ToastInterface) => ToastMixin.fire({
    icon: ALERT_ICON_INFO,
    title,
    text
  }),
}
import Swal from "sweetalert2";

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
  success: (title) => ToastMixin.fire({
    icon: 'success',
    title: title
  }),
  error: (title) => ToastMixin.fire({
    icon: 'error',
    title: title
  }),
  danger: (title) => ToastMixin.fire({
    icon: 'danger',
    title: title
  }),
  info: (title) => ToastMixin.fire({
    icon: 'info',
    title: title
  }),
}
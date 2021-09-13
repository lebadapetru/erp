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
  success: ({ title, text }: { title: string, text?: string }) => ToastMixin.fire({
    icon: 'success',
    title,
    text
  }),
  error: ({ title, text }: { title: string, text?: string }) => ToastMixin.fire({
    icon: 'error',
    title,
    text
  }),
  warning: ({ title, text }: { title: string, text?: string }) => ToastMixin.fire({
    icon: 'warning',
    title,
    text
  }),
  info: ({ title, text }: { title: string, text?: string }) => ToastMixin.fire({
    icon: 'info',
    title,
    text
  }),
}
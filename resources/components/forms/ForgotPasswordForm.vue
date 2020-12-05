<template>
  <Form
    class="form text-center"
    id="kt_login_forgot_form"
    @submit="onSubmit"
  >
    <div class="form-group mb-10">
      <EmailInput
        style-classes="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
        :rules="email"
      />
    </div>
    <div class="form-group">
      <button id="kt_login_forgot_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3 m-2">Request</button>
      <a
        @click="showLoginSection"
        id="kt_login_signup_cancel"
        class="btn btn-pill btn-outline-white opacity-70 px-15 py-3 m-2"
      >Cancel</a>
    </div>
  </Form>
</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate'
import EmailInput from "./inputs/EmailInput";
import { string } from "yup";
import { useStore } from "vuex";
import Swal from "sweetalert2";

export default {
  name: "ForgotPasswordForm",
  components: {
    Form,
    Field,
    ErrorMessage,
    EmailInput
  },
  setup() {
    const store = useStore()

    function onSubmit(values) {
      httpClient.post('/forgot-password', values).then(async (response) => {
        console.log(response)
        await Swal.fire({
          text: 'An email containing the password reset link has been sent to you',
          icon: "info",
          buttonsStyling: false,
          confirmButtonText: "Ok, got it!",
          customClass: {
            confirmButton: "btn font-weight-bold btn-light-primary"
          },
          heightAuto: false
        })
      })
    }

    return {
      onSubmit,
      email: string().required('Email address is required').email(),
      showLoginSection: () => store.commit('setActiveSection', 'login')
    }
  }
}
</script>

<style scoped>

</style>
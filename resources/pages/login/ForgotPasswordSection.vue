<template>
  <!--begin::Login forgot password form-->
  <div
    v-if="activeSection === 'forgot-password'"
    class="login-forgot"
  >
    <div class="mb-20">
      <h3 class="opacity-40 font-weight-normal">Forgotten Password ?</h3>
      <p class="opacity-40">Enter your email to reset your password</p>
    </div>
    <ForgotPasswordForm />
  </div>
  <!--end::Login forgot password form-->
</template>

<script>
import ForgotPasswordForm from 'resources/components/forms/ForgotPasswordForm'
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "ForgotPasswordSection",
  components: {
    ForgotPasswordForm
  },
  setup() {
    const store = useStore()

    return {
      activeSection: computed(() => store.state.activeSection),
    }
  }
}
</script>

<style scoped>

</style>
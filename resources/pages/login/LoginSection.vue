<template>
  <!--begin::Login Sign in form-->
  <div
    v-if="activeSection === 'login'"
    class="login-signin"
  >
    <div class="mb-20">
      <h3 class="opacity-40 font-weight-normal">Sign In To Admin</h3>
      <p class="opacity-40">Enter your details to login to your account:</p>
    </div>
    <LoginForm />
    <div class="mt-10">
      <span class="opacity-40 mr-4">Don't have an account yet?</span>
      <a
        href="javascript:;"
        @click="showRegisterSection"
        id="kt_login_signup"
        class="text-white opacity-30 font-weight-normal"
      >Sign Up</a>
    </div>
  </div>
  <!--end::Login Sign in form-->
</template>

<script>
import LoginForm from "resources/components/forms/LoginForm";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "LoginSection",
  components: {
    LoginForm
  },
  setup() {
    const store = useStore()

    return {
      activeSection: computed(() => store.state.activeSection),
      showRegisterSection: () => store.commit('setActiveSection', 'register')
    }
  }
}
</script>

<style scoped>

</style>
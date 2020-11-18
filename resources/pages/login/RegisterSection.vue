<template>
  <!--begin::Login Sign up form-->
  <div
      v-if="activeSection === 'register'"
      class="login-signup"
  >
    <div class="mb-20">
      <h3 class="opacity-40 font-weight-normal">Sign Up</h3>
      <p class="opacity-40">Enter your details to create your account</p>
    </div>
    <RegisterForm />
  </div>
  <!--end::Login Sign up form-->
</template>

<script>
import RegisterForm from "resources/components/forms/RegisterForm";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "RegisterSection",
  components: {
    RegisterForm
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
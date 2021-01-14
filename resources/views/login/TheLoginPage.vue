<template>
  <!--begin::Login-->
  <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
    <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"
         style="background-image: url(build/media/bg/bg-2.jpg);">
      <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
        <!--begin::Login Header-->
        <div class="d-flex flex-center mb-15">
          <a href="#">
            <img src="build/media/logos/logo-letter-13.png" class="max-h-75px" alt="" />
          </a>
        </div>
        <!--end::Login Header-->
        <LoginSection />
        <RegisterSection />
        <ForgotPasswordSection />
      </div>
    </div>
  </div>
  <!--end::Login-->
</template>

<script>
import LoginSection from "resources/views/login/TheLoginSection";
import RegisterSection from "resources/views/login/TheRegisterSection";
import ForgotPasswordSection from "resources/views/login/TheForgotPasswordSection";

export default {
  name: "TheLoginPage",
  components: {
    LoginSection,
    RegisterSection,
    ForgotPasswordSection
  }
}
</script>

<style lang="scss">
@import "resources/assets/sass/login";
</style>
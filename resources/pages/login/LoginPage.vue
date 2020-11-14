<template>
  <!--begin::Login-->
  <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
    <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url(build/media/bg/bg-2.jpg);">
      <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
        <!--begin::Login Header-->
        <div class="d-flex flex-center mb-15">
          <a href="#">
            <img src="build/media/logos/logo-letter-13.png" class="max-h-75px" alt=""/>
          </a>
        </div>
        <!--end::Login Header-->
        <!--begin::Login Sign in form-->
        <div class="login-signin">
          <div class="mb-20">
            <h3 class="opacity-40 font-weight-normal">Sign In To Admin</h3>
            <p class="opacity-40">Enter your details to login to your account:</p>
          </div>
          <LoginForm/>
          <div class="mt-10">
            <span class="opacity-40 mr-4">Don't have an account yet?</span>
            <a href="javascript:;" id="kt_login_signup" class="text-white opacity-30 font-weight-normal">Sign Up</a>
          </div>
        </div>
        <!--end::Login Sign in form-->
      </div>
    </div>
  </div>
  <!--end::Login-->
</template>

<script>
import LoginForm from "resources/components/forms/LoginForm";

export default {
  name: "LoginPage",
  components: {
    LoginForm
  }
}
</script>

<style lang="scss">
@import "resources/sass/login";
</style>
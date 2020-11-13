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
          <!--<form
              class="form"
              id="kt_login_signin_form"
              novalidate
              @submit.prevent="onSubmit"
          >
            <div class="form-group">
              <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text"
                     placeholder="Email" name="email" autocomplete="nope" value="{{ last_username }}"/>
            </div>
            <div class="form-group">
              <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                     type="password" placeholder="Password" name="password"/>
            </div>
            <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
              <div class="checkbox-inline">
                <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                  <input type="checkbox" name="_remember_me"/>
                  <span></span>Remember me</label>
              </div>
              <a href="javascript:;" id="kt_login_forgot" class="text-white font-weight-bold">Forgot Password ?</a>
            </div>
            <div class="form-group text-center mt-10">
              <button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Sign In
              </button>
            </div>
          </form>-->
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
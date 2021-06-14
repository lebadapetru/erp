<template>
  <Form
      class="form w-100"
      id="kt_sign_in_form"
      @submit="onSubmit"
      :validation-schema="schema"
  >
    <!--begin::Heading-->
    <div class="text-center mb-10">
      <!--begin::Title-->
      <h1 class="text-dark mb-3">Sign In to Metronic</h1>
      <!--end::Title-->
      <!--begin::Link-->
      <div class="text-gray-400 fw-bold fs-4">New Here?
        <a href="authentication/flows/dark/sign-up.html" class="link-primary fw-bolder">Create an Account</a></div>
      <!--end::Link-->
    </div>
    <!--begin::Heading-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
      <VBaseInput
          input-style-classes="form-control form-control-lg form-control-solid"
          label-style-classes="form-label fs-6 fw-bolder text-dark"
          type="text"
          placeholder="Email"
          autocomplete="email"
          name="email"
          label="Email"
          v-model:model-value="email"
      />
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="fv-row mb-10">
      <!--begin::Wrapper-->
      <div class="d-flex flex-stack mb-2">
        <!--begin::Label-->
        <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
        <!--end::Label-->
        <!--begin::Link-->
        <a href="authentication/flows/dark/password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
        <!--end::Link-->
      </div>
      <!--end::Wrapper-->
      <VBaseInput
          input-style-classes="form-control form-control-lg form-control-solid"
          label-style-classes="form-label fw-bolder text-dark fs-6 mb-0"
          type="password"
          placeholder="Password"
          autocomplete="password"
          name="password"
          v-model:model-value="password"
      />
    </div>
    <!--end::Input group-->

    <div class="fv-row mb-10">
      <label class="form-check form-check-custom form-check-solid">
        <Field type="checkbox" name="_remember_me" as="input" value="true" class="form-check-input h-20px w-20px" />
        <span class="form-check-label fw-bolder fs-5">Remember me</span>
      </label>
    </div>

    <!--begin::Actions-->
    <div class="text-center">
      <!--begin::Submit button-->
      <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
        <span class="indicator-label">Continue</span>
        <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
      </button>
      <!--end::Submit button-->
      <!--begin::Separator-->
      <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
      <!--end::Separator-->
      <!--begin::Google link-->
      <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
        <img alt="Logo" src="build/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Continue with Google</a>
      <!--end::Google link-->
      <!--begin::Google link-->
      <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
        <img alt="Logo" src="build/media/svg/brand-logos/facebook-4.svg" class="h-20px me-3" />Continue with Facebook</a>
      <!--end::Google link-->
      <!--begin::Google link-->
      <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
        <img alt="Logo" src="build/media/svg/brand-logos/apple-black.svg" class="h-20px me-3" />Continue with Apple</a>
      <!--end::Google link-->
    </div>
    <!--end::Actions-->
  </Form>
</template>

<script>
import { Form, Field } from 'vee-validate'
import VBaseInput from "./inputs/VBaseInput";
import { object, string } from 'yup'

export default {
  name: "VLoginForm",
  components: {
    Form,
    Field,
    VBaseInput,
  },
  setup() {
    const schema = object().shape({
      email: string().required('Email address is required').email('Email address is invalid'),
      password: string().required('Password is required').min(8).max(128),
    });

    function onSubmit(values) {
      httpClient.post('/login', values, {
        headers: {
          accept: 'application/json',
        }
      }).then(() => {
         window.location.href = '/';
      })
    }

    return {
      email: '',
      password: '',
      schema,
      onSubmit,
    }
  }
}
</script>

<style scoped>

</style>
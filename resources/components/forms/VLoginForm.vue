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
    </div>
    <!--begin::Heading-->
    <!--begin::Input group-->
    <div class="row mb-10">
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
    <div class="row mb-10">
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

    <div class="row mb-10">
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
    </div>
    <!--end::Actions-->
  </Form>
</template>

<script lang="ts">
import { Form, Field } from 'vee-validate'
import VBaseInput from "./inputs/VBaseInput.vue";
import { object, string } from 'yup'
import { useRouter } from "vue-router";
import { defineComponent } from "vue";

export default defineComponent({
  name: "VLoginForm",
  components: {
    Form,
    Field,
    VBaseInput,
  },
  setup() {
    const router = useRouter()

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
         router.push({name: 'home'})
      })
    }

    return {
      email: '',
      password: '',
      schema,
      onSubmit,
    }
  }
})
</script>

<style scoped>

</style>
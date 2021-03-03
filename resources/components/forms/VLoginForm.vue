<template>
  <Form
      class="form"
      id="kt_login_signin_form"
      @submit="onSubmit"
      :validation-schema="schema"
  >
    <div class="form-group">
      <VBaseInput
          style-classes="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
          type="text"
          placeholder="Email"
          autocomplete="email"
          name="email"
      />
    </div>
    <div class="form-group">
      <VBaseInput
          style-classes="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
          type="text"
          placeholder="Password"
          autocomplete="password"
          name="password"
      />
    </div>
    <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
      <div class="checkbox-inline">
        <label class="checkbox checkbox-outline checkbox-white text-white m-0">
          <Field type="checkbox" name="_remember_me" as="input" value="true" />
          <span></span>Remember me</label>
      </div>
      <a
          href="javascript:;"
          id="kt_login_forgot"
          class="text-white font-weight-bold"
          @click="showForgotPasswordSection"
      >Forgot Password ?</a>
    </div>
    <div class="form-group text-center mt-10">
      <button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3" type="submit">Sign In
      </button>
    </div>
  </Form>
</template>

<script>
import { Form, Field } from 'vee-validate'
import VBaseInput from "./inputs/VBaseInput";
import { object, string } from 'yup'
import { useStore } from "vuex";

export default {
  name: "VLoginForm",
  components: {
    Form,
    Field,
    VBaseInput,
  },
  setup() {
    const store = useStore()

    const schema = object().shape({
      email: string().required('Email address is required').email('Email address is invalid'),
      password: string().required('Password is required').min(8).max(128),
    });

    function onSubmit(values) {
      httpClient.post('/login', values).then(() => {
         window.location.href = '/';
      })
    }

    return {
      schema,
      onSubmit,
      showForgotPasswordSection: () => store.commit('setActiveSection', 'forgot-password')
    }
  }
}
</script>

<style scoped>

</style>
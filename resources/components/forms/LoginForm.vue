<template>
  <Form
      class="form"
      id="kt_login_signin_form"
      @submit="onSubmit"
      :validation-schema="schema"
  >
    <div class="form-group">
      <EmailInput
          style-classes="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
      />
    </div>
    <div class="form-group">
      <PasswordInput
          style-classes="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
      />
    </div>
    <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
      <div class="checkbox-inline">
        <label class="checkbox checkbox-outline checkbox-white text-white m-0">
          <Field type="checkbox" name="_remember_me" as="input" value="true"/>
          <span></span>Remember me</label>
      </div>
      <a href="javascript:;" id="kt_login_forgot" class="text-white font-weight-bold">Forget Password ?</a>
    </div>
    <div class="form-group text-center mt-10">
      <button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3" type="submit">Sign In
      </button>
    </div>
  </Form>
</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate'
import EmailInput from "./inputs/EmailInput";
import PasswordInput from "./inputs/PasswordInput";
import { object, string } from 'yup'

export default {
  name: "LoginForm",
  components: {
    Form,
    Field,
    ErrorMessage,
    EmailInput,
    PasswordInput
  },
  setup() {
    const schema = object().shape({
      email: string().required().email('invalid email'),
      password: string().required().min(8),
    });
    function onSubmit(values) {
      console.log('yolo')
      console.log(values)
    }

    return {
      schema,
      onSubmit
    }
  }
}
</script>

<style scoped>

</style>
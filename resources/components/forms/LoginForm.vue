<template>
  <Form
      class="form"
      id="kt_login_signin_form"
  >
    <EmailInput/>
  </Form>
</template>

<script>
import { Form } from 'vee-validate'
import EmailInput from "./inputs/EmailInput";

export default {
  name: "LoginForm",
  components: {
    Form,
    EmailInput
  }
}
</script>

<style scoped>

</style>
<template>
  <Form
      class="form text-center"
      id="kt_login_signup_form"
      @submit="onSubmit"
      :validation-schema="schema"
  >
    <div class="row">
      <div class="col">
        <div class="form-group">
          <VBaseInput
              type="text"
              style-classes="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
              placeholder="First name"
              name="firstName"
              autocomplete="given-name"
          />
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <VBaseInput
              type="text"
              style-classes="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
              placeholder="Last name"
              name="lastName"
              autocomplete="family-name"
          />
        </div>
      </div>
    </div>
    <div class="form-group">
      <VBaseInput
          type="text"
          style-classes="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
          placeholder="Email"
          autocomplete="email"
          name="email"
      />
    </div>
    <div class="form-group">
      <VBaseInput
          style-classes="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
          placeholder="Password"
          autocomplete="password"
          name="password"
      />
    </div>
    <div class="form-group">
      <VBaseInput
          style-classes="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
          placeholder="Confirm Password"
          autocomplete="password"
          name="confirmPassword"
      />
    </div>
    <div class="form-group px-8">
      <div class="checkbox-inline justify-content-center">
        <label class="checkbox checkbox-outline checkbox-white opacity-60 text-white m-0">
          <Field type="checkbox" name="agreeTermsAndConditions" value="true" />
          <span></span>I agree with the
          <a href="#" @click="openTermsAndConditions" class="text-white font-weight-bold ml-1">terms and conditions</a>.</label>
        <ErrorMessage class="error-message" as="p" name="agreeTermsAndConditions" />
      </div>
      <div class="form-text text-muted text-center"></div>
    </div>
    <div class="form-group">
      <button id="kt_login_signup_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3 m-2">Sign Up</button>
      <a
          @click="showLoginSection"
          id="kt_login_signup_cancel"
          class="btn btn-pill btn-outline-white opacity-70 px-15 py-3 m-2"
      >Cancel</a>
    </div>
  </Form>
</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate'
import { object, string, ref as yupRef } from 'yup'
import VBaseInput from "./inputs/VBaseInput";
import Swal from 'sweetalert2'
import { LoremIpsum } from "lorem-ipsum";
import { useStore } from "vuex";
import { ref } from 'vue'

export default {
  name: "VRegisterForm",
  components: {
    Form,
    Field,
    ErrorMessage,
    VBaseInput
  },
  setup() {
    const store = useStore()

    const schema = object().shape({
      firstName: string().trim().required('First name is required'),
      lastName: string().trim().required('Last name is required'),
      email: string().required('Email address is required').email(),
      password: string().trim().required('Password is required').min(8).max(128), /*TODO implement strong password validation*/
      confirmPassword: string().required('Password confirmation is required').oneOf([yupRef("password")], 'Passwords do not match'),
      agreeTermsAndConditions: string().required('You must accept the terms and conditions')
    });

    const openTermsAndConditions = () => {
      const lorem = new LoremIpsum({
        sentencesPerParagraph: {
          max: 8,
          min: 4
        },
        wordsPerSentence: {
          max: 16,
          min: 4
        }
      });
      Swal.fire({
        text: lorem.generateParagraphs(7),
        icon: "info",
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
          confirmButton: "btn font-weight-bold btn-light-primary"
        },
        heightAuto: false
      })
    }

    const onSubmit = (values) => {
      httpClient.post('/register', values).then((response) => {
        Swal.fire({
          text: response.data,
          icon: "success",
          buttonsStyling: false,
          confirmButtonText: "Ok, got it!",
          customClass: {
            confirmButton: "btn font-weight-bold btn-light-primary"
          },
          heightAuto: false
        }).then(() => {
          window.location = '/'
        })
      })
    }

    return {
      schema,
      openTermsAndConditions,
      onSubmit,
      showLoginSection: () => store.commit('setActiveSection', 'login')
    }
  }
}
</script>

<style scoped>

</style>
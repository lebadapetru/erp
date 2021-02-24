<template>
  <input
      type="password"
      :class="styleClasses"
      :name="name"
      :id="name"
      :value="inputValue"
      :placeholder="placeholder"
      :autocomplete="autocomplete"
      @input="handleChange"
      @blur="handleBlur"
  />
  <p class="error-message" v-if="errorMessage">
    {{ capitalize(errorMessage) }}
  </p>
</template>

<script>
import { useField } from "vee-validate";
import capitalize from 'lodash/capitalize'

export default {
  name: "VPasswordInput",
  props: {
    styleClasses: {
      type: String,
      default: 'form-control'
    },
    placeholder: {
      type: String,
      default: 'Password'
    },
    autocomplete: {
      type: String,
      default: 'password'
    },
    value: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: 'password',
    },
    successMessage: {
      type: String,
      default: '',
    },
  },
  setup(props) {
    const {
      value: inputValue,
      errorMessage,
      handleBlur,
      handleChange,
      meta,
    } = useField(props.name, undefined, {
      initialValue: props.value,
    });

    return {
      handleChange,
      errorMessage,
      handleBlur,
      inputValue,
      meta,
      capitalize
    };
  },
}
</script>

<style scoped>

</style>
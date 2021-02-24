<template>
  <input
      type="text"
      :class="styleClasses"
      :name="name"
      :id="name"
      :value="inputValue"
      :placeholder="placeholder"
      :autocomplete="autocomplete"
      @input="handleChange"
      @blur="handleBlur"
  />
  <div class="error-message" v-if="errorMessage">
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script>
import { useField } from 'vee-validate'
import capitalize from 'lodash/capitalize'

export default {
  name: "VEmailInput",
  props: {
    styleClasses: {
      type: String,
      default: 'form-control'
    },
    placeholder: {
      type: String,
      default: 'Email'
    },
    autocomplete: {
      type: String,
      default: 'email'
    },
    value: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: 'email',
    },
    successMessage: {
      type: String,
      default: '',
    },
    rules: {
      type: Object,
      default: undefined
    }
  },
  setup(props) {
    const {
      value: inputValue,
      errorMessage,
      handleBlur,
      handleChange,
      meta,
    } = useField(props.name, props.rules, {
      initialValue: props.value,
    });

    return {
      handleChange,
      handleBlur,
      errorMessage,
      inputValue,
      meta,
      capitalize
    };
  },
}
</script>

<style scoped>

</style>
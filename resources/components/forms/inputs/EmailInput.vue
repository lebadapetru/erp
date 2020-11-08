<template>
  <label :for="name">
    <span v-if="label">{{ label }}</span>
    <input
        class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
        type="text"
        :name="name"
        :id="name"
        :value="inputValue"
        :placeholder="placeholder"
        :autocomplete="autocomplete"
        @input="handleChange"
        @blur="handleBlur"
    />
  </label>
</template>

<script>
import { useField } from 'vee-validate'
import { string } from 'yup';

export default {
  name: "EmailInput",
  props: {
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
    label: {
      type: String,
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
    } = useField(props.name, string().email(), {
      initialValue: props.value,
    });

    return {
      handleChange,
      handleBlur,
      errorMessage,
      inputValue,
      meta,
    };
  },
}
</script>

<style scoped>

</style>
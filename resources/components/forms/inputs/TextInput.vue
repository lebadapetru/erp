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
import { capitalize } from 'lodash'

export default {
  name: "FullNameInput",
  props: {
    styleClasses: {
      type: String,
      default: 'form-control'
    },
    placeholder: {
      type: String,
      default: 'Text'
    },
    autocomplete: {
      type: String,
      default: 'on'
    },
    value: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: 'text',
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
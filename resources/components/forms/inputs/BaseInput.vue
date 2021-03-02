<template>
  <input
      :type="type"
      :class="styleClasses"
      :name="name"
      :id="name"
      :value="inputValue"
      :placeholder="placeholder"
      :autocomplete="autocomplete"
      @input="emitEvent"
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
  name: "BaseInput",
  props: {
    type: {
      type: String,
      default: 'text'
    },
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
    name: {
      type: String,
      default: 'text',
    },
    modelValue: {
      type: [String, Number],
      default: ''
    },
    rules: {
      type: Object,
      default: undefined
    }
  },
  emits: ['update:modelValue'],
  setup(props, {emit}) {
    const {
      value: inputValue,
      errorMessage,
      handleBlur,
      handleChange,
      meta,
    } = useField(props.name, props.rules, {
      initialValue: props.modelValue,
    });

    const emitEvent = (event) => {
      handleChange(event)
      emit('update:modelValue', event.target.value);
    }

    return {
      emitEvent,
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
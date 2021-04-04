<template>
  <label v-if="label">{{ label }}</label>
  <input
    v-bind="$attrs"
    :type="type"
    :class="styleClasses"
    :name="name"
    :id="name"
    :value="inputValue"
    :placeholder="placeholder"
    :autocomplete="autocomplete"
    :min="(type === 'number') ? min : undefined"
    :max="(type === 'number') ? max : undefined"
    @input="onInput"
    @blur="handleBlur"
    @keypress="onKeyPress"
  />
  <div v-if="errorMessage" class="error-message">
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script>
import { useField } from 'vee-validate'
import { watch } from 'vue'
import capitalize from 'lodash/capitalize'

export default {
  name: "VBaseInput",
  props: {
    label: {
      type: String,
      default: ''
    },
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
    },
    min: {
      type: Number,
      default: undefined
    },
    max: {
      type: Number,
      default: undefined
    }
  },
  emits: ['update:modelValue', 'keypress'],
  setup(props, { emit }) {
    const {
      value: inputValue,
      errorMessage,
      handleBlur,
      handleInput,
    } = useField(props.name, props.rules, {
      initialValue: props.modelValue,
    });

    const onInput = (event) => {
      handleInput(event)
      emit('update:modelValue', event.target.value);
    }

    const onKeyPress = (event) => {
      emit('keypress', event);
    }

    watch(() => props.modelValue, value => {
      inputValue.value = value;
    });

    return {
      onInput,
      onKeyPress,
      handleBlur,
      errorMessage,
      inputValue,
      capitalize
    }
  },
}
</script>

<style scoped>

</style>
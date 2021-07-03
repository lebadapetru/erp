<template>
  <label
    v-if="label"
    :class="labelStyleClasses"
  >
    {{ label }}
  </label>
  <input
    v-bind="$attrs"
    :type="type"
    :class="inputStyleClasses"
    :name="name"
    :id="name"
    :value="modelValue"
    :placeholder="placeholder"
    :autocomplete="autocomplete"
    :min="min"
    :max="max"
    @input="onInput"
    @blur="handleBlur"
    @keypress="integerFilter"
  />
  <div v-if="errorMessage" class="error-message" role="alert">
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script>
import { useField } from 'vee-validate'
import { watch } from 'vue'
import capitalize from 'lodash/capitalize'
import { integerFilter } from "resources/js/helpers/inputFilters";

export default {
  name: "VIntegerInput",
  props: {
    label: {
      type: String,
      default: ''
    },
    type: {
      type: String,
      default: 'number'
    },
    inputStyleClasses: {
      type: String,
      default: 'form-control'
    },
    labelStyleClasses: {
      type: String,
      default: 'form-label'
    },
    placeholder: {
      type: String,
      default: '0'
    },
    autocomplete: {
      type: String,
      default: 'off'
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
  emits: ['update:modelValue'],
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

      emit('update:modelValue', event.target.value)
    }

    watch(() => props.modelValue, value => {
      inputValue.value = value
    })

    return {
      onInput,
      handleBlur,
      errorMessage,
      inputValue,
      capitalize,
      integerFilter,
    }
  },
}
</script>

<style scoped>

</style>
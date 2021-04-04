<template>
  <label v-if="label">{{ label }}</label>
  <select
    :class="styleClasses"
    :value="modelValue"
    v-bind="{
      ...$attrs,
      onChange
    }"
  >
    <option value="" disabled selected>{{ placeholder }}</option>
    <option
      v-for="(option, index) in options"
      :value="option.value"
      :key="index"
      :selected="index === modelValue"
      :name="name"
    >
      {{ option.label }}
    </option>
  </select>
  <div v-if="errorMessage" class="error-message">
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script>
import { useField } from 'vee-validate'
import { watch } from 'vue'
import capitalize from 'lodash/capitalize'

export default {
  name: "VBaseSelect",
  props: {
    placeholder: {
      type: String,
      default: 'Select your option'
    },
    label: {
      type: String,
      default: ''
    },
    modelValue: {
      type: [String, Number],
      default: ''
    },
    options: {
      type: Array,
      required: true
    },
    styleClasses: {
      type: String,
      default: 'custom-select form-control'
    },
    name: {
      type: String,
      required: true
    }
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    const {
      value: inputValue,
      errorMessage,
      handleChange,
    } = useField(props.name, props.rules, {
      initialValue: props.modelValue,
    });

    const onChange = (event) => {
      handleChange(event)
      emit('update:modelValue', event.target.value)
    }

    watch(() => props.modelValue, value => {
      inputValue.value = value;
    });

    return {
      onChange,
      handleChange,
      errorMessage,
      inputValue,
      capitalize
    }
  }
}
</script>
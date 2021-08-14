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
    @input="onInput"
    @blur="handleBlur"
  />
  <div v-if="errorMessage" class="error-message" role="alert">
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script lang="ts">
import { useField } from 'vee-validate'
import { watch, defineComponent } from 'vue'
import capitalize from 'lodash/capitalize'

export default defineComponent({
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
      default: 'Text'
    },
    autocomplete: {
      type: String,
      default: 'on'
    },
    name: {
      type: String,
      required: true,
    },
    modelValue: {
      type: [String, Number],
      default: ''
    },
    rules: {
      type: Object,
      default: undefined
    },
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
      capitalize
    }
  },
})
</script>

<style scoped>

</style>
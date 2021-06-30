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
    :value="modelValue"
    placeholder=""
    :autocomplete="autocomplete"
    ref="el"
    @input="onInput"
    @blur="handleBlur"
  />

  <div v-if="errorMessage" class="error-message" role="alert">
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script>
import { onMounted, ref, watch } from "vue";
import Inputmask from "inputmask";
import { useField } from "vee-validate";

export default {
  name: "VCurrencyInput",
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
  },
  setup(props, {emit}) {
    const el = ref(null)
    const {
      value: inputValue,
      errorMessage,
      handleBlur,
      handleInput,
    } = useField(props.name, props.rules, {
      initialValue: props.modelValue,
    });

    const onInput = (event) => {
      handleInput(event.target.value)
      emit('update:modelValue', event.target.value)
    }

    watch(() => props.modelValue, value => {
      inputValue.value = value
    })

    onMounted(() => {
      Inputmask({
        groupSeparator: false,
        radixPoint: '.',
        alias: "numeric",
        placeholder: "0",
        autoGroup: true,
        integerDigits: 9,
        digits: 2,
        digitsOptional: false,
        numericInput: true,
        clearMaskOnLostFocus: false
      }).mask(el.value);
    })
    return {
      onInput,
      handleBlur,
      errorMessage,
      el,
    }
  }
}
</script>

<style scoped>

</style>
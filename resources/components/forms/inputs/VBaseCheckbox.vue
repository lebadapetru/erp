<template>
  <label class="checkbox">
    <input
      type="checkbox"
      :name="name"
      :checked="checkboxChecked"
      :value="valueProp"
      :class="styleClasses"
      @change="onChange"
    />
    <span></span>{{ label }}
  </label>
  <div v-if="errorMessage" class="error-message">
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script>
import { useField } from 'vee-validate'
import capitalize from 'lodash/capitalize'

export default {
  props: {
    label: {
      type: String,
      default: ''
    },
    checked: {
      type: Boolean,
      default: false
    },
    value: {
      type: [Boolean, String, Number],
      default: true
    },
    styleClasses: {
      type: String,
      default: ''
    },
    rules: {
      type: Object,
      default: undefined
    },
    name: {
      type: String,
      require: true
    }
  },
  emits: ['update:checked'],
  setup(props, { emit }) {
    const {
      checked: checkboxChecked,
      value: checkboxValue,
      valueProp,
      errorMessage,
      handleChange,
    } = useField(props.name, props.rules, {
      type: 'checkbox',
      valueProp: props.value,
      initialValue: props.checked,
    });

    const onChange = (event) => {
      handleChange(props.value)
      emit('update:checked', event.target.checked)
    }

    return {
      onChange,
      handleChange,
      errorMessage,
      capitalize,
      checkboxChecked,
      checkboxValue,
      valueProp
    }
  }
}
</script>

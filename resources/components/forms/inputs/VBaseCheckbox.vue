<template>
  <label class="checkbox">
    <input
      type="checkbox"
      :name="name"
      :checked="checked"
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
import { watch } from 'vue'
import capitalize from 'lodash/capitalize'

export default {
  props: {
    label: {
      type: String,
      default: ''
    },
    modelValue: {
      type: Boolean,
      default: false
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
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    const {
      checked,
      value: checkboxValue,
      errorMessage,
      handleChange,
    } = useField(props.name, props.rules, {
      type: 'checkbox',
      valueProp: props.modelValue,
      initialValue: props.modelValue,
    });

    const onChange = (event) => {
      handleChange(event.target.checked)
      emit('update:modelValue', event.target.checked)
    }

    return {
      onChange,
      handleChange,
      errorMessage,
      capitalize,
      checked,
      checkboxValue,
    }
  }
}
</script>

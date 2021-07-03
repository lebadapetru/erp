<template>
  <div :class="wrapperStyleClasses" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
    <input
      v-bind="$attrs"
      type="checkbox"
      :name="name"
      :checked="checkboxChecked"
      :value="checkboxValue"
      @change="onChange"
      :class="inputStyleClasses"
      :id="`${id}-${name}`"
    />
    <label :class="labelStyleClasses" :for="`${id}-${name}`">
      {{ label }}
    </label>
  </div>

  <div v-if="errorMessage" class="error-message">
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script>
import { useField } from 'vee-validate'
import capitalize from 'lodash/capitalize'
import { watch } from "vue";

export default {
  props: {
    id: {
      type: String,
      default: 'checkbox'
    },
    label: {
      type: String,
      default: ''
    },
    checked: {
      type: Boolean,
      default: false
    },
    inputStyleClasses: {
      type: String,
      default: 'form-check-input'
    },
    labelStyleClasses: {
      type: String,
      default: 'form-check-label'
    },
    wrapperStyleClasses: {
      type: String,
      default: 'form-check form-check-custom form-check-solid form-check-sm'
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
      valueProp: true,
      initialValue: props.checked,
    });

    const onChange = (event) => {
      handleChange(event.target.checked)
      emit('update:checked', event.target.checked)
    }

    watch(() => props.checked, value => {
      checkboxValue.value = value
    })

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

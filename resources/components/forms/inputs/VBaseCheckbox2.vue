<template>
  <div :class="wrapperStyleClasses" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
    <input
      type="checkbox"
      :checked="value"
      @change="$emit('update:modelValue', $event.target.checked)"
      :class="inputStyleClasses"
      :id="`${id}-${name}`"
      :value="value"
    />
    <label :class="labelStyleClasses" :for="`${id}-${name}`">
      {{ label }}
    </label>
  </div>
</template>

<script>
export default {
  name: "VBaseCheckbox2",
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
    },
    value: {
      type: String,
      require: false
    }
  },
}
</script>
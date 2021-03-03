<template>
  <label v-if="label.trim().length">{{ label }}</label>
  <select
      :class="styleClasses"
      :value="modelValue"
      v-bind="{
      ...$attrs,
      onChange: ($event) => { $emit('update:modelValue', $event.target.value) }
    }"
  >
    <option value="" disabled selected>{{ placeholder }}</option>
    <option
        v-for="option in options"
        :value="option"
        :key="option"
        :selected="option === modelValue"
    >{{ option }}</option>
  </select>
</template>

<script>
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
  }
}
</script>
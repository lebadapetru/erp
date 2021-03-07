<template>
  <form ref="el" @submit="onSubmit">
    <slot />
  </form>
</template>

<script>
import { useForm } from 'vee-validate'
import { ref } from 'vue'

export default {
  name: "VBaseForm",
  emits: ["submit"],
  props: {
    validationSchema: {
      type: Object,
      required: true,
    },
    styleClasses: {
      type: String,
      default: 'form'
    }
  },
  setup(props, { emit }) {
    const el = ref(null)

    const { handleSubmit } = useForm({
      validationSchema: props.validationSchema,
    });

    const onSubmit = handleSubmit((values) => {
      emit("submit", values);
    });

    return {
      el,
      onSubmit
    }
  }
}
</script>

<style scoped>

</style>
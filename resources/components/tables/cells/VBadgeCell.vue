<template>
  <div class="badge badge-light-success">{{ isPublic }}</div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "VBadgeCell",
  props: {
    label: {
      type: String,
      required: true
    },
    badge: {
      type: String,
      required: true
    },
  },
  setup(props) {
    return {}
  }
})
</script>

<style scoped>

</style>
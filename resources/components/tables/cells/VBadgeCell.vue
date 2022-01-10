<template>
  <div class="badge badge-light-success">{{ isPublic }}</div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "VBadgeCell",
  props: {
    isPublic: {
      type: String,
      required: true
    }
  },
  setup(props) {
    return {}
  }
})
</script>

<style scoped>

</style>
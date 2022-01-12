<template>
  <div class="badge badge-light-success">{{ isPublic }}</div>
</template>

<script lang="ts">
import { defineComponent, PropType } from "vue";
import { StatusBadgeInterface } from "resources/components/tables/ts/types";

export default defineComponent({
  name: "VStatusBadgeCell",
  props: {
    statusBadge: {
      type: Object as PropType<StatusBadgeInterface>,
      required: true,
    }
  },
  setup(props) {


    return {}
  }
})
</script>

<style scoped>

</style>
<template>
  <td
    v-for="(cellValue, cellKey) in rowValues"
    :key="rowIndex + cellKey"
  >
    <slot
      :name="`${cellKey}Cell`"
      :value="cellValue"
    >{{ cellValue }}</slot>
  </td>
  <template v-if="actions.length > 0">
    <td>
      <slot name="actions" :actions="actions">
        <VActionsCell />
      </slot>
    </td>
  </template>
</template>

<script>
import VActionsCell from "resources/components/tables/v-base-table/cells/VActionsCell";

export default {
  name: "VBaseRow",
  components: {
    VActionsCell,
  },
  props: {

  }
}
</script>

<style scoped>

</style>
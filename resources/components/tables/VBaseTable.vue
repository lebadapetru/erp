<template>
  <!--begin: Table-->
  <div class="table-responsive">
    <table class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
      <thead class="fs-7 text-gray-400">
      <tr>
        <th
          v-for="(column, index) in columns"
          :key="index"
          scope="col"
        >
          {{ column.name }}
        </th>
        <th
          v-if="actions.length > 0"
          class="text-end"
          scope="col"
        >
          Actions
        </th>
      </tr>
      </thead>
      <tbody class="fs-7">
      <tr
        v-for="(item, index) in items"
        :key="index"
      >
        <td
          v-for="(value, key) in item"
          :key="key + index"
        >
          <slot :name="key" :value="value">{{ value }}</slot>
        </td>
        <template v-if="actions.length > 0">
          <td>
            <slot name="actions" :actions="actions">
              <VActionsCell />
            </slot>
          </td>
        </template>
      </tr>
      </tbody>
    </table>
  </div>
  <!--end: Table-->
</template>

<script>
import VActionsCell from "resources/components/tables/cells/VActionsCell";
import { computed } from "vue";

export default {
  name: "VCustomTable",
  components: {
    VActionsCell,
  },
  props: {
    columns: {
      type: Array,
      required: true
    },
    items: {
      type: Array,
      required: true
    },
    actions: {
      type: Array,
      required: false
    },
  },
  setup(props) {
    const items = computed(() => {
      let items = []
      props.items.forEach(item => {
        let obj = {}
        props.columns.forEach(column => {
          obj[column.key] = item[column.key]
        })
        items.push(obj)
      })

      return items
    })


    return {
      items,
    }
  }
}
</script>

<style scoped>

</style>
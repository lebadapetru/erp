<template>
  <!--begin: Table-->
  <div class="table-responsive">
    <table class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
      <thead class="fs-7 text-gray-400">
      <tr>
        <th class="w-25px">
          <div class="form-check form-check-sm form-check-custom form-check-solid">
            <VBaseCheckbox2
              :input-style-classes="'form-check-input widget-9-check'"
              v-model="test"
            />
          </div>
        </th>
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
          v-for="(rowValues, rowIndex) in items"
          :key="rowIndex"
        >
          <slot name="row" :value="rowValues" :index="rowIndex">
            <th class="w-25px">
              ceva
            </th>
            <td
              v-for="(cellValue, cellKey) in rowValues"
              :key="rowIndex + cellKey"
            >
              <slot
                :name="`${cellKey}Cell`"
                :value="cellValue"
                :item-id="rowIndex"
              >{{ cellValue }}</slot>
            </td>
            <template v-if="actions.length > 0">
              <td>
                <slot name="actions" :actions="actions">
                  <VActionsCell />
                </slot>
              </td>
            </template>
          </slot>
      </tr>
      </tbody>
    </table>
  </div>
  <!--end: Table-->
</template>

<script>
import VActionsCell from "resources/components/tables/cells/VActionsCell";
import { computed, ref } from "vue";
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox";
import VBaseCheckbox2 from "resources/components/forms/inputs/VBaseCheckbox2";

export default {
  name: "VCustomTable",
  components: {
    VBaseCheckbox2,
    VBaseCheckbox,
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
      test: ref([])
    }
  }
}
</script>

<style scoped>

</style>
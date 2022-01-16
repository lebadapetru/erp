<template>
  <!--begin: Table-->
  <div class="table-responsive">
    <table class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
      <thead class="fs-7 text-gray-400">
      <tr>
        <th
          v-if="canSelectItems"
          class="w-25px"
        >
          <div class="form-check form-check-sm form-check-custom form-check-solid">
            <input
              type="checkbox"
              class="form-check-input widget-9-check"
              :name="name"
              v-model="areAllItemsSelected"
            />
          </div>
        </th>
        <th
          v-for="(column, index) in columns"
          :key="index"
          :class="[hasWidth ? `w-${column.width}px min-w-${column.width}px` : null]"
          scope="col"
        >
          {{ column.name }}
        </th>
        <th
          v-if="hasActions"
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
          <th
            v-if="canSelectItems"
            class="w-25px"
          >
            <div class="form-check form-check-sm form-check-custom form-check-solid">
              <input
                type="checkbox"
                class="form-check-input widget-9-check"
                :name="`${name}-${rowIndex}`"
                :value="rowIndex"
                v-model="selectedItems"
              />
            </div>
          </th>
          <template
            v-for="(cellValue, cellKey) in rowValues"
            :key="rowIndex + cellKey"
          >
            <td
              v-if="cellKey !== 'id'"
            >
              <slot
                :name="`${cellKey}Cell`"
                :value="cellValue"
                :item-id="rowIndex"
              >
                {{ cellValue }}
              </slot>
            </td>
          </template>
          <template v-if="hasActions">
            <td>
              <slot name="actions" :item-id="rowIndex" :actions="actions">
                <VActionsCell
                  :id="rowValues.id"
                  :actions="actions"
                />
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

<script lang="ts">
import VActionsCell from "resources/components/tables/v-base-table/cells/VActionsCell.vue";
import { computed, defineComponent, PropType, ref, watch } from "vue";
import { TableColumnInterface } from "resources/components/tables/ts/types";
import isFunction from 'lodash/isFunction'

export default defineComponent({
  name: "VBaseTable",
  components: {
    VActionsCell,
  },
  props: {
    columns: {
      type: Array as PropType<TableColumnInterface[]>,
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
    name: {
      type: String,
      required: true
    },
    canSelectItems: {
      type: Boolean,
      default: false
    },
  },
  emits: ['itemSelected'],
  setup(props, { emit }) {
    const areAllItemsSelected = ref(false)
    let selectedItems = ref([])

    const items = computed(() => {
      let items = []
      props.items.forEach(item => {
        let obj = {
          id: item['id']
        }

        props.columns.forEach(column => {
          if (column.hasOwnProperty('fieldParser') && isFunction(column.fieldParser)) {
            obj[column.key] = column.fieldParser(item[column.key])
          } else {
            obj[column.key] = item[column.key]
          }
        })
        items.push(obj)
      })
      console.log('items')
      console.log(items)
      return items
    })

    watch(areAllItemsSelected, (newValue) => {
      if (newValue) {
        items.value.forEach((item, index) => {
          selectedItems.value.push(index)
        })
      } else {
        selectedItems.value = []
      }

    })

    watch(() => selectedItems, (newValue) => {
      emit('itemSelected', newValue)
    }, { deep: true })

    return {
      items,
      selectedItems,
      areAllItemsSelected,
      hasWidth: (column: TableColumnInterface) => (column.hasOwnProperty('width') && column.width),
      hasActions: () => props.actions.length > 0,
    }
  }
})
</script>

<style scoped>

</style>
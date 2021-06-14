<template>
  <!--begin: Table-->
  <div class="table-responsive">
    <table class="table">
      <thead>
      <tr>
        <th
          v-for="(column, index) in columns"
          :key="index"
          scope="col"
        >
          {{ column.name }}
        </th>
      </tr>
      </thead>
      <tbody>
      <tr
        v-for="(item, index) in items"
        :key="index"
      >
        <td
          v-for="(value, key) in item"
          :key="key + index"
        >
          {{ value }}
        </td>
      </tr>
      </tbody>
    </table>
  </div>
  <!--end: Table-->
</template>

<script>
import { computed } from "vue";

export default {
  name: "VCustomTable",
  props: {
    columns: {
      type: Array,
      required: true
    },
    items: {
      type: Array,
      required: true
    }
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
      items
    }
  }
}
</script>

<style scoped>

</style>
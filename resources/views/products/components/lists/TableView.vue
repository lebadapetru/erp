<template>
  <!--begin::Card-->
  <div class="card card-flush mb-5">
    <div class="card-body pt-0">
      <VBaseTable
        :columns="columns"
        :items="products"
        :actions="actions"
      >
        <template v-slot:title="titleProps">
          <VTitleCell :value="titleProps.value" />
        </template>
      </VBaseTable>
    </div>
  </div>
  <!--end::Card-->
</template>

<script>
import VBaseTable from "resources/components/tables/VBaseTable";
import VTitleCell from "resources/components/tables/cells/VTitleCell";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "TableView",
  components: {
    VBaseTable,
    VTitleCell,
  },
  setup() {
    const store = useStore()
    const columns = [
      {
        name: 'Title',
        key: 'title',
      },
      {
        name: 'Inventory',
        key: 'quantity',
      },
      {
        name: 'Description',
        key: 'shortDescription',
      },
      {
        name: 'Is Public',
        key: 'isPublic',
      },
      {
        name: 'Updated At',
        key: 'updatedAt',
      },
      {
        name: 'Created At',
        key: 'createdAt',
      },
    ]
    const products = computed(() => store.getters['products/getProducts'])
    const actions = [
      {
        name: 'Edit',
      }
    ]

    return {
      columns,
      products,
      actions,
    }
  }
}
</script>

<style scoped>

</style>
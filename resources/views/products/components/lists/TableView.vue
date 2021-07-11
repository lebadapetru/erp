<template>
  <!--begin::Card-->
  <div class="card card-flush mb-5">
    <div class="card-body pt-0">
      <VBaseTable
        :columns="columns"
        :items="products"
        :actions="actions"
      >
        <template v-slot:titleCell="props">
          <VTitleCell
            :title="props.value"
            :avatar-path="getAvatar(props.itemId)"
          />
        </template>
      </VBaseTable>
    </div>
  </div>
  <!--end::Card-->
</template>

<script>
import VBaseTable from "resources/components/tables/VBaseTable";
import VBaseRow from "resources/components/tables/rows/VBaseRow";
import VTitleCell from "resources/components/tables/cells/VTitleCell";
import { setImageSize, getImagePlaceholderPath } from "resources/ts/helpers";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "TableView",
  components: {
    VBaseTable,
    VBaseRow,
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
      getAvatar: (id) => {
        let url = getImagePlaceholderPath();
        if(products.value[id].files.length > 0) {
          url = products.value[id].files[0].file.url //first image
        }

        return setImageSize(url)
      }
    }
  }
}
</script>

<style scoped>

</style>
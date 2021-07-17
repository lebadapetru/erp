<template>
  <!--begin::Card-->
  <div class="card card-flush mb-5">
    <div class="card-body pt-0">
      <VBaseTable
        :name="'products'"
        :can-select-items="true"
        :columns="columns"
        :items="products"
        :actions="actions"
        @item-selected="itemSelected"
      >
        <template v-slot:titleCell="props">
          <VTitleCell
            :title="props.value"
            :avatar-path="getAvatar(props.itemId)"
          />
        </template>
        <template v-slot:actions="props">
          <VActionsCell
            :item-id="props.itemId"
            @editItem="editProduct"
            @deleteItem="deleteProduct"
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
import VActionsCell from "resources/components/tables/cells/VActionsCell";
import { useRouter } from "vue-router";

export default {
  name: "TableView",
  components: {
    VActionsCell,
    VBaseTable,
    VBaseRow,
    VTitleCell,
  },
  setup() {
    const store = useStore()
    const router = useRouter()
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
        if (products.value[id].files.length > 0) {
          url = products.value[id].files[0].file.url //first image
        }

        return setImageSize(url)
      },
      itemSelected: (value) => {
        console.log('event')
        console.log(value)
      },
      editProduct: (id) => {
        router.push({ name: 'editProduct', params: {id: products.value[id].id}})
      },
      deleteProduct: (id) => {
        store.dispatch('product/deleteProduct', products.value[id].id).then(() => {
          store.dispatch('products/readProducts')
        })
      }
    }
  }
}
</script>

<style scoped>

</style>
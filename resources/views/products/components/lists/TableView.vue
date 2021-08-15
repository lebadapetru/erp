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
        <template v-slot:shortTitleCell="props">
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

<script lang="ts">
import VBaseTable from "resources/components/tables/VBaseTable.vue";
import VTitleCell from "resources/components/tables/cells/VTitleCell.vue";
import VActionsCell from "resources/components/tables/cells/VActionsCell.vue";
import { setImageSize, getImagePlaceholderPath } from "resources/ts/helpers.ts";
import { useStore } from "vuex";
import { computed, defineComponent } from "vue";
import { useRouter } from "vue-router";

export default defineComponent({
  name: "TableView",
  components: {
    VActionsCell,
    VBaseTable,
    VTitleCell,
  },
  setup() {
    const store = useStore()
    const router = useRouter()
    const columns = [
      {
        name: 'Title',
        key: 'shortTitle',
        width: 300,
      },
      {
        name: 'Inventory',
        key: 'quantity',
      },
      {
        name: 'Status',
        key: 'status',
        fieldParser: (status) => {
          return status.name
        }
      },
      {
        name: 'Visibility',
        key: 'isPublic',
        fieldParser: (isPublic) => {
          return isPublic ? 'Public' : 'Private'
        }
      },
      {
        name: 'Updated At',
        key: 'updatedAtForHumans',
        width: 250,
      },
      {
        name: 'Created At',
        key: 'createdAtForHumans',
        width: 250,
      },
    ]
    const products = computed(() => store.getters['products/getItems'])
    const actions = [
      {
        name: 'Edit',
      }
    ]

    return {
      columns,
      products,
      actions,
      getAvatar: (itemId) => {
        let url = getImagePlaceholderPath();
        if (products.value[itemId].files.length > 0) {
          url = products.value[itemId].files[0].file.url //first image
        }

        return setImageSize(url)
      },
      itemSelected: (itemId) => {
        console.log('event')
        console.log(itemId)
      },
      editProduct: (itemId) => {
        router.push({ name: 'editProduct', params: {id: products.value[itemId].id}})
      },
      deleteProduct: (itemId) => {
        store.dispatch('product/deleteProduct', products.value[itemId].id).then(() => {
          store.dispatch('products/readProducts')
        })
      }
    }
  }
})
</script>

<style scoped>

</style>
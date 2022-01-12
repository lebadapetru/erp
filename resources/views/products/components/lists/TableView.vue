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
            :item-id="props.itemId"
            :title="props.value"
            :avatar-path="getAvatar(props.itemId)"
            @editItem="editProduct"
          />
        </template>
      </VBaseTable>
    </div>
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import VBaseTable from "resources/components/tables/v-base-table/VBaseTable.vue";
import VTitleCell from "resources/components/tables/v-base-table/cells/VTitleCell.vue";
import VActionsCell from "resources/components/tables/v-base-table/cells/VActionsCell.vue";
import { setImageSize, getImagePlaceholderPath } from "resources/ts/helpers";
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
        name: 'Product',
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
        fieldParser: (isPublic: boolean): string => {
          return isPublic ? 'public' : 'private'
        }
      },
      {
        name: 'Updated At',
        key: 'updatedAtForHumans',
        width: 200,
      },
      {
        name: 'Created At',
        key: 'createdAtForHumans',
        width: 200,
      },
    ]
    const products = computed(() => store.getters['products/getItems'])
    const actions = [
      {
        name: 'Edit',
        dispatchAction: (id: string): void => {
          router.push({ name: 'editProduct', params: { id } })
        }
      },
      {
        name: 'Delete',
        dispatchAction: (id: string): void => {
          store.dispatch('product/deleteProduct', id).then(() => {
            store.dispatch('products/read')
          })
        }
      }
    ]

    return {
      columns,
      products,
      actions,
      getAvatar: (itemId) => {
        let url = getImagePlaceholderPath();
        if (products.value[itemId].productFiles.length > 0) {
          url = products.value[itemId].productFiles[0].file.url //TODO get by first position
        }

        return setImageSize(url)
      },
      itemSelected: (itemId) => {
        console.log('event')
        console.log(itemId)
      },
      editProduct: (itemId) => {
        router.push({ name: 'editProduct', params: { id: products.value[itemId].id } })
      },
      deleteProduct: (itemId) => {
        store.dispatch('product/deleteProduct', products.value[itemId].id).then(() => {
          store.dispatch('products/read')
        })
      }
    }
  }
})
</script>

<style scoped>

</style>
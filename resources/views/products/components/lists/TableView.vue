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
        <template v-slot:isPublicCell="props">
          <VBadgeCell
            :is-public="props.value"
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
import { setImageSize, getImagePlaceholderPath } from "resources/ts/helpers";
import { useStore } from "vuex";
import { computed, defineComponent } from "vue";
import { useRouter } from "vue-router";
import VBadgeCell from "resources/components/tables/cells/VBadgeCell.vue";

export default defineComponent({
  name: "TableView",
  components: {
    VBadgeCell,
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
        fieldParser: (isPublic: boolean): object => {
          return {
            label: isPublic ? 'Public' : 'Private',
            value: isPublic,
            badge: true
          }
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
      }
    ]

    return {
      columns,
      products,
      actions,
      getAvatar: (itemId) => {
        let url = getImagePlaceholderPath();
        console.log('getAvatar')
        console.log(products)
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
        router.push({ name: 'editProduct', params: {id: products.value[itemId].id}})
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
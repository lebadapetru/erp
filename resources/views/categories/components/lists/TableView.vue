<template>
  <!--begin::Card-->
  <div class="card card-flush mb-5">
    <div class="card-body pt-0">
      <VBaseTable
        :name="'categories'"
        :can-select-items="true"
        :columns="columns"
        :items="categories"
        :actions="actions"
        @item-selected="itemSelected"
      >
        <template v-slot:title="props">
          <VTitleCell
            :title="props.value"
          />
        </template>
        <template v-slot:actions="props">
          <VActionsCell
            :item-id="props.itemId"
            @editItem="editCategory"
            @deleteItem="deleteCategory"
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
        key: 'title',
        width: 300,
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
    const categories = computed(() => store.getters['categories/getItems'])
    const actions = [
      {
        name: 'Edit',
      }
    ]

    return {
      columns,
      categories,
      actions,
      itemSelected: (itemId) => {
        console.log('event')
        console.log(itemId)
      },
      editCategory: (itemId) => {
        store.commit('category/setId', categories.value[itemId].id)
        store.commit('modals/showEditCategoryModal')
      },
      deleteCategory: (itemId) => {
        store.dispatch('category/delete', categories.value[itemId].id).then(() => {
          store.dispatch('categories/read')
        })
      }
    }
  }
})
</script>

<style scoped>

</style>
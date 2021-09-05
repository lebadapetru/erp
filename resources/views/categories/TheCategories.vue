<template>
  <div v-if="currentRoute.name === 'categories'">
    <VPagination
      v-if="totalCategories"
      :style-classes="'mb-5'"
      :total-items="totalCategories"
      :label="'categories'"
      :module="'categories'"
    />
    <TableView />
    <VPagination
      v-if="totalCategories"
      :total-items="totalCategories"
      :label="'categories'"
      :module="'categories'"
    />

    <VCategoriesToolbar />
    <VAddCategoryModal v-if="isAddCategoryModalVisible" />
    <VEditCategoryModal v-if="isEditCategoryModalVisible" />
  </div>
  <router-view></router-view>
</template>

<script lang="ts">
import VPagination from "resources/components/VPagination.vue";
import TableView from "resources/views/categories/components/lists/TableView.vue";
import { useRouter } from "vue-router";
import { usePagination } from "resources/views/products/ts/pagination";
import VCategoriesToolbar from "resources/views/categories/components/teleports/VCategoriesToolbar.vue";
import { computed, defineAsyncComponent, defineComponent } from "vue";
import { useStore } from "vuex";

export default defineComponent({
  name: "TheCategories",
  components: {
    VAddCategoryModal: defineAsyncComponent(() => import("resources/views/categories/components/modals/VAddCategoryModal.vue")),
    VEditCategoryModal: defineAsyncComponent(() => import("resources/views/categories/components/modals/VEditCategoryModal.vue")),
    TableView,
    VPagination,
    VCategoriesToolbar,
  },
  setup () {
    const router = useRouter()
    const pagination = usePagination('categories')
    const store = useStore()



    return {
      isAddCategoryModalVisible: computed(() => store.getters['modals/isAddCategoryModalVisible']),
      isEditCategoryModalVisible: computed(() => store.getters['modals/isEditCategoryModalVisible']),
      currentRoute: router.currentRoute,
      totalCategories: pagination.totalItems,
    }
  }
})
</script>

<style scoped>

</style>
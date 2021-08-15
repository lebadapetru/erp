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
    <VAddCategoryModal />
  </div>
  <router-view></router-view>
</template>

<script lang="ts">
import VPagination from "resources/components/VPagination";
import TableView from "resources/views/categories/components/lists/TableView";
import { useRouter } from "vue-router";
import { usePagination } from "resources/views/products/ts/pagination";
import VCategoriesToolbar from "resources/views/categories/components/teleports/VCategoriesToolbar";
import { defineAsyncComponent, defineComponent } from "vue";

export default defineComponent({
  name: "TheCategories",
  components: {
    VAddCategoryModal: defineAsyncComponent(() => import("resources/views/categories/components/modals/VAddCategoryModal")),
    TableView,
    VPagination,
    VCategoriesToolbar,
  },
  setup () {
    const router = useRouter()
    const pagination = usePagination('categories')

    return {
      currentRoute: router.currentRoute,
      totalCategories: pagination.totalItems,
    }
  }
})
</script>

<style scoped>

</style>
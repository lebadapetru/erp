<template>
  <div v-if="currentRoute.name === 'products'">
    <VPagination
      v-if="totalProducts"
      :style-classes="'mb-8'"
      :total-items="totalProducts"
      :label="'products'"
    />
    <TableView v-if="isTableView" />
    <GridView v-else-if="isGridView" />
    <VPagination
      v-if="totalProducts"
      :total-items="totalProducts"
      :label="'products'"
    />

    <VProductsToolbar />
  </div>
  <router-view></router-view>
</template>

<script>
import { useRouter } from "vue-router";
import VPagination from "resources/components/VPagination";
import VProductsToolbar from "resources/views/products/components/teleports/VProductsToolbar";
import GridView from "resources/views/products/components/lists/GridView";
import TableView from "resources/views/products/components/lists/TableView";
import { usePagination } from "resources/views/products/js/pagination";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "TheProducts",
  components: {
    VPagination,
    GridView,
    TableView,
    VProductsToolbar,
  },
  setup() {
    const store = useStore()
    const router = useRouter()
    const pagination = usePagination()

    const activeView = computed(() => store.getters['products/getActiveView'])

    return {
      currentRoute: router.currentRoute,
      totalProducts: pagination.totalProducts,
      activeView,
      isTableView: () => activeView.value === 'table',
      isGridView: () => activeView.value === 'grid',
    }
  }
}
</script>

<style scoped>

</style>
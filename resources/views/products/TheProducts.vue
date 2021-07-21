<template>
  <div v-if="currentRoute.name === 'products'">
    <VPagination
      v-if="totalProducts"
      :style-classes="'mb-5'"
      :total-items="totalProducts"
      :label="'products'"
      :module="'products'"
    />
    <TableView v-if="isTableView" />
    <GridView v-else-if="isGridView" />
    <VPagination
      v-if="totalProducts"
      :total-items="totalProducts"
      :label="'products'"
      :module="'products'"
    />

    <VProductsToolbar v-if="totalProducts" />
  </div>
  <router-view></router-view>
</template>

<script lang="ts">
import { useRouter } from "vue-router";
import VPagination from "resources/components/VPagination.vue";
import VProductsToolbar from "resources/views/products/components/teleports/VProductsToolbar.vue";
import GridView from "resources/views/products/components/lists/GridView.vue";
import TableView from "resources/views/products/components/lists/TableView.vue";
import { usePagination } from "resources/views/products/ts/pagination";
import { useStore } from "vuex";
import { computed, defineComponent } from "vue";

export default defineComponent ({
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
    const pagination = usePagination('products')

    const activeView = computed(() => store.getters['products/getActiveView'])

    return {
      currentRoute: router.currentRoute,
      totalProducts: pagination.totalItems,
      activeView,
      isTableView: () => activeView.value === 'table',
      isGridView: () => activeView.value === 'grid',
    }
  }
})
</script>

<style scoped>

</style>
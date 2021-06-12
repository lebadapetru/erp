<template>
  <div v-if="currentRoute.name === 'Products'">
    <VPagination
      v-if="totalProducts"
      :style-classes="'mb-8'"
      :total-items="totalProducts"
      :label="'products'"
    />
    <GridView />
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

export default {
  name: "TheProducts",
  components: {
    VPagination,
    GridView,
    TableView,
    VProductsToolbar,
  },
  setup() {
    const router = useRouter()
    const pagination = usePagination()

    return {
      currentRoute: router.currentRoute,
      totalProducts: pagination.totalProducts,
    }
  }
}
</script>

<style scoped>

</style>
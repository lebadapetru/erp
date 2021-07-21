<template>
  <div v-if="currentRoute.name === 'categories'">
    <VPagination
      v-if="totalProducts"
      :style-classes="'mb-5'"
      :total-items="totalProducts"
      :label="'products'"
    />
    <TableView />
    <VPagination
      v-if="totalProducts"
      :total-items="totalProducts"
      :label="'products'"
    />
  </div>
  <router-view></router-view>
</template>

<script>
import VPagination from "resources/components/VPagination";
import TableView from "resources/views/products/components/lists/TableView";
import { useRouter } from "vue-router";
import { usePagination } from "resources/views/products/ts/pagination";
export default {
  name: "TheCategories",
  components: {
    TableView,
    VPagination
  },
  setup () {
    const router = useRouter()
    const pagination = usePagination()

    return {
      currentRoute: router.currentRoute,
      totalCategories: pagination.totalProducts,
    }
  }
}
</script>

<style scoped>

</style>
<template>
  <div v-if="currentRoute.name === 'Products'">

    <VPagination :style-classes="'mb-8'" />

    <div class="row">
      <GridView />
    </div>

    <VPagination />

    <VProductsToolbar />
  </div>
  <router-view></router-view>
</template>

<script>
import { useRouter } from "vue-router";
import VProductsToolbar from "resources/views/products/components/teleports/VProductsToolbar";
import VPagination from "resources/components/VPagination";
import GridView from "resources/views/products/components/lists/GridView";

export default {
  name: "TheProducts",
  components: {
    VProductsToolbar,
    VPagination,
    GridView,
  },
  setup() {
    const router = useRouter()

    return {
      currentRoute: router.currentRoute,
    }
  }
}
</script>

<style scoped>

</style>
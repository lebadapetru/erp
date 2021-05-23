<template>
  <div v-if="currentRoute.name === 'Products'">

    <div class="row">
      <GridView />
    </div>

    <VProductsToolbar />
  </div>
  <router-view></router-view>
</template>

<script>
import { useRouter } from "vue-router";
import VProductsToolbar from "resources/views/products/components/teleports/VProductsToolbar";
import GridView from "resources/views/products/components/lists/GridView";

export default {
  name: "TheProducts",
  components: {
    VProductsToolbar,
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
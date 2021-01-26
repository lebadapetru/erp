<template>
  <div v-if="currentRoute.name === 'Products'">
    <h1>The products</h1>
  </div>
  <router-view></router-view>
</template>

<script>
import { useRouter } from "vue-router";

export default {
  name: "TheProducts",
  setup() {
    const router = useRouter()

    return {
      currentRoute: router.currentRoute
    }
  }
}
</script>

<style scoped>

</style>
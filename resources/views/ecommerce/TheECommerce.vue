<template>
  <div v-if="currentRoute.name === 'E-commerce'">
    <h1>TheECommerce</h1>
  </div>
  <router-view></router-view>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { useRouter } from 'vue-router';

export default defineComponent({
  name: "TheECommerce",
  setup() {
    const router = useRouter()

    return {
      currentRoute: router.currentRoute
    }
  }
})
</script>

<style scoped>

</style>
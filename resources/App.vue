<template>
  <router-view />
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  name: 'App',
  setup() {
    const store = useStore()

    return {
      isOverlayVisible: computed(() => store.state.globals.isOverlayVisible)
    }
  }
}
</script>

<style lang="scss">
// Import Main styles for this application
@import "./assets/sass/style";

</style>

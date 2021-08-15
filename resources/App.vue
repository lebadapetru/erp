<template>
  <VFlashMessage />
  <router-view />
</template>

<script>

import VFlashMessage from "resources/components/alerts/VFlashMessage";
export default {
  name: 'App',
  components: { VFlashMessage },
  setup() {
    return {
    }
  }
}
</script>

<style lang="scss">
// Import Main styles for this application
@import "assets/sass/style";
@import "./assets/fonts/poppins/poppins.css";
@import "~@fortawesome/fontawesome-free/css/all.min.css";

//dropzone
@import "~dropzone/src/dropzone.scss";
@import "~dropzone/src/basic.scss";

@import "./assets/sass/overwrite";
</style>

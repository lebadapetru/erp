<template>
  <!--begin::Container-->
  <div class="container-fluid d-flex align-items-stretch justify-content-between">
    <TheHeaderMenu />

    <TheTopBar />
  </div>
  <!--end::Container-->
</template>

<script>
import TheHeaderMenu from "./TheHeaderMenu";
import TheTopBar from "./TheTopBar";

export default {
  name: "TheHeader",
  components: {
    TheHeaderMenu,
    TheTopBar
  }
}
</script>

<style scoped>

</style>
<template>
  <!--begin::Container-->
  <div class="container-fluid d-flex align-items-stretch justify-content-between">
    <HeaderMenu/>

    <TopBar/>
  </div>
  <!--end::Container-->
</template>

<script>
import HeaderMenu from "./HeaderMenu";
import TopBar from "./TopBar";

export default {
  name: "Header",
  components: {
    HeaderMenu,
    TopBar
  }
}
</script>

<style scoped>

</style>
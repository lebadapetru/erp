<template>
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-2">
      <!--begin::Actions-->
      <TheBreadcrumbs />
      <!--end::Actions-->
    </div>
    <!--end::Info-->
    <!--begin::Toolbar-->
    <div id="toolbar" class="d-flex align-items-center">

    </div>
    <!--end::Toolbar-->
  </div>
</template>

<script>
import TheBreadcrumbs from "resources/views/base/TheBreadcrumbs";

export default {
  name: "TheSubHeader",
  components: {
    TheBreadcrumbs
  },
  setup() {
  }
}
</script>

<style scoped>

</style>
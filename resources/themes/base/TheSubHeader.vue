<template>
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-2">
      <TheBreadcrumbs />
      <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
      <div id="toolbar-left" class="d-flex align-items-center">

      </div>
    </div>
    <!--end::Info-->
    <!--begin::Toolbar-->
    <div id="toolbar-right" class="d-flex align-items-center">

    </div>
    <!--end::Toolbar-->
  </div>
</template>

<script>
import TheBreadcrumbs from "resources/themes/base/TheBreadcrumbs";

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
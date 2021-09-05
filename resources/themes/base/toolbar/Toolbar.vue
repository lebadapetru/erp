<template>
  <!--begin::Toolbar-->
  <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
      <Breadcrumbs />

      <!--begin::Actions-->
      <div id="toolbar_actions" class="d-flex flex-grow-1 align-items-center py-1">
      </div>
      <!--end::Actions-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Toolbar-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import InlineSvg from "vue-inline-svg";
import Breadcrumbs from "resources/themes/base/Breadcrumbs.vue";
import Dropdown1 from "resources/themes/base/dropdown/Dropdown1.vue";

export default defineComponent({
  name: "Toolbar",
  components: {
    Breadcrumbs,
    InlineSvg,
    Dropdown1,
  }
})
</script>

<style scoped>

</style>
<template>
  <!--begin::Aside-->
  <div
    id="kt_aside"
    class="aside aside-dark aside-hoverable"
  >
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
      <!--begin::Logo-->
      <a href="#">
        <img alt="Logo" src="/build/media/logos/logo-1.svg" class="h-15px logo" />
      </a>
      <!--end::Logo-->

      <!--begin::Aside toggler-->
      <div
        id="kt_aside_toggle"
        class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
      >
        <span class="svg-icon svg-icon-1 rotate-180">
          <inline-svg
            :src="'build/media/icons/duotone/Navigation/Angle-double-left.svg'"
          />
        </span>
      </div>
      <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->

    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
      <Menu />
    </div>
    <!--end::Aside menu-->


  </div>
  <!--end::Aside-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import InlineSvg from "vue-inline-svg";
import Menu from "resources/themes/base/aside/Menu.vue";

export default defineComponent({
  name: "Aside",
  components: {
    InlineSvg,
    Menu,
  }
})
</script>

<style scoped>

</style>
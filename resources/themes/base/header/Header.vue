<template>
  <!--begin::Header-->
  <div id="kt_header" style="" class="header align-items-stretch">
    <!--begin::Container-->
    <div
      class="container-fluid d-flex align-items-stretch justify-content-between"
    >
      <!--begin::Aside mobile toggle-->
      <div
        class="d-flex align-items-center d-lg-none ms-n3 me-1"
        title="Show aside menu"
      >
        <div
          class="btn btn-icon btn-active-light-primary"
          id="kt_aside_mobile_toggle"
        >
          <span class="svg-icon svg-icon-2x mt-1">
            <inline-svg src="/build/media/icons/duotone/Text/Menu.svg" />
          </span>
        </div>
      </div>
      <!--end::Aside mobile toggle-->

      <!--begin::Mobile logo-->
      <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
        <a href="#" class="d-lg-none">
          <img alt="Logo" src="/build/media/logos/logo-3.svg" class="h-30px" />
        </a>
      </div>
      <!--end::Mobile logo-->

      <!--begin::Wrapper-->
      <div
        class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
      >
        <!--begin::Navbar-->
        <div
          class="d-flex align-items-stretch"
          id="kt_header_menu_nav"
        >
          <Menu />
        </div>
        <!--end::Navbar-->

        <!--begin::Topbar-->
        <div class="d-flex align-items-stretch flex-shrink-0">
          <TopBar />
        </div>
        <!--end::Topbar-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Header-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import InlineSvg from "vue-inline-svg";
import Menu from "resources/themes/base/header/Menu.vue";
import TopBar from "resources/themes/base/header/TopBar.vue";

export default defineComponent({
  name: "Header",
  components: {
    InlineSvg,
    Menu,
    TopBar,
  }
})
</script>

<style scoped>

</style>
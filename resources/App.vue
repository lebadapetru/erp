<template>
  <!--begin::Page-->
  <div class="d-flex flex-row flex-column-fluid page">
    <TheLeftNav />

    <!--begin::Wrapper-->
    <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
      <!--begin::Header-->
      <div class="header header-fixed" id="kt_header">
        <TheHeader />
      </div>
      <!--end::Header-->

      <!--begin::Content-->
      <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
          <TheSubHeader />
        </div>

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
          <!--begin::Container-->
          <div class="container">
            <router-view></router-view>
          </div>
          <!--end::Container-->
        </div>
        <!--end::Entry-->
      </div>
      <!--end::Content-->
      <!--begin::Footer-->
      <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
        <TheFooter />
      </div>
      <!--end::Footer-->
    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Page-->

  <!-- begin::User Panel-->
  <TheUserPanel />
  <!-- end::User Panel-->
  <div
      v-if="isOverlayVisible"
      class="offcanvas-overlay"
  ></div>
</template>

<script>
import TheLeftNav from "./views/base/TheLeftNav";
import TheHeader from "./views/base/TheHeader";
import TheSubHeader from "./views/base/TheSubHeader";
import TheFooter from "./views/base/TheFooter";
import TheUserPanel from "./views/base/TheUserPanel";
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  name: 'App',
  components: {
    TheLeftNav,
    TheHeader,
    TheSubHeader,
    TheFooter,
    TheUserPanel
  },
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
@import "./assets/fonts/poppins/poppins.css";
@import "./assets/fonts/keenthemes-icons/font/ki.css";
@import "./assets/plugins/flaticon/flaticon.css";
@import "./assets/plugins/flaticon2/flaticon.css";
@import "./assets/sass/style";
</style>

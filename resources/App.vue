<template>
  <!--begin::Page-->
  <div class="d-flex flex-row flex-column-fluid page">
    <LeftNav />

    <!--begin::Wrapper-->
    <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
      <!--begin::Header-->
      <div class="header header-fixed" id="kt_header">
        <Header />
      </div>
      <!--end::Header-->

      <!--begin::Content-->
      <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
          <SubHeader />
        </div>

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
          <MainContent />
        </div>
        <!--end::Entry-->
      </div>
      <!--end::Content-->
      <!--begin::Footer-->
      <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
        <Footer />
      </div>
      <!--end::Footer-->
    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Page-->

  <!-- begin::User Panel-->
  <UserPanel />
  <!-- end::User Panel-->
  <div
      v-if="isOverlayVisible"
      class="offcanvas-overlay"
  ></div>
</template>

<script>
import LeftNav from "./LeftNav";
import Header from "./Header";
import SubHeader from "./SubHeader";
import MainContent from "./MainContent";
import Footer from "./Footer";
import UserPanel from "./components/UserPanel";
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  name: 'App',
  components: {
    LeftNav,
    Header,
    SubHeader,
    MainContent,
    Footer,
    UserPanel
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
@import "fonts/poppins/poppins.css";
@import "sass/style";
</style>

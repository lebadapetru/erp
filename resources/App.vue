<template>
  <!--begin::App-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
      <LeftNav/>

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
            <SubHeader/>
          </div>

          <!--begin::Entry-->
          <div class="d-flex flex-column-fluid">
            <MainContent />
          </div>
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
          <Footer/>
        </div>
        <!--end::Footer-->
      </div>
      <!--end::Wrapper-->
    </div>
  </div>
  <!--end::App-->
</template>

<script>
import LeftNav from "./LeftNav";
import Header from "./Header";
import SubHeader from "./SubHeader";
import MainContent from "./MainContent";
import Footer from "./Footer";

export default {
  name: 'App',
  components: {
    LeftNav,
    Header,
    SubHeader,
    MainContent,
    Footer
  }
}
</script>

<style lang="scss">
// Import Main styles for this application
@import "sass/style";
</style>

<template>
  <!-- begin:: Body -->
  <div class="page d-flex flex-row flex-column-fluid">
    <!-- begin:: Aside Left -->
    <Aside />
    <!-- end:: Aside Left -->

    <div id="kt_wrapper" class="d-flex flex-column flex-row-fluid wrapper">
      <Header />

      <!-- begin:: Content -->
      <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
        <!-- begin:: Content Head -->
        <ToolBar />
        <!-- end:: Content Head -->

        <!-- begin:: Content Body -->
        <div class="post d-flex flex-column-fluid">
          <div
            class="container"
          >
            <router-view />
          </div>
        </div>
        <!-- end:: Content Body -->
      </div>
      <!-- end:: Content -->
      <Footer />
    </div>
  </div>
  <!-- end:: Body -->
</template>

<script>
import Aside from "resources/themes/base/aside/Aside";
import Header from "resources/themes/base/header/Header";
import ToolBar from "resources/themes/base/toolbar/ToolBar";
import Footer from "resources/themes/base/footer/Footer";

export default {
  name: "Layout",
  components: {
    Aside,
    Header,
    ToolBar,
    Footer,
  },
  setup() {}

}
</script>

<style scoped>

</style>
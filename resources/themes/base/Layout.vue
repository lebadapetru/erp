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
        <Toolbar />
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

<script lang="ts">
import { defineComponent } from "vue";
import Aside from "resources/themes/base/aside/Aside.vue";
import Header from "resources/themes/base/header/Header.vue";
import Toolbar from "resources/themes/base/toolbar/Toolbar.vue";
import Footer from "resources/themes/base/footer/Footer.vue";

export default defineComponent({
  name: "Layout",
  components: {
    Aside,
    Header,
    Toolbar,
    Footer,
  },
  setup() {}

})
</script>

<style scoped>

</style>
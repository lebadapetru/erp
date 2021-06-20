<template>
  <!-- begin:: Body -->
  <div class="page d-flex flex-row flex-column-fluid">
    <!-- begin:: Aside Left -->
    <Aside />
    <!-- end:: Aside Left -->

    <div id="kt_wrapper" class="d-flex flex-column flex-row-fluid wrapper">
      <KTHeader :title="pageTitle"></KTHeader>

      <!-- begin:: Content -->
      <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
        <!-- begin:: Content Head -->
        <KTToolbar
          v-if="subheaderDisplay && !isDocPage"
          :breadcrumbs="breadcrumbs"
          :title="pageTitle"
        />
        <!-- end:: Content Head -->

        <!-- begin:: Content Body -->
        <div class="post d-flex flex-column-fluid">
          <div
            :class="{
              'container-fluid': contentWidthFluid,
              container: !contentWidthFluid
            }"
          >
            <router-view />
          </div>
        </div>
        <!-- end:: Content Body -->
      </div>
      <!-- end:: Content -->
      <KTFooter></KTFooter>
    </div>
  </div>
  <!-- end:: Body -->
</template>

<script>
import Aside from "resources/themes/base/aside/Aside";
export default {
  name: "Layout",
  components: {
    Aside,
  }
}
</script>

<style scoped>

</style>
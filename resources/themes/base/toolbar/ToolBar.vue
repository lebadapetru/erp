<template>
  <!--begin::Toolbar-->
  <div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
      <Breadcrumbs />

      <!--begin::Actions-->
      <div class="d-flex align-items-center py-1">
        <!--begin::Wrapper-->
        <div class="me-4">
          <!--begin::Menu-->
          <a
            href="#"
            class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
          >
            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
              <inline-svg src="build/media/icons/duotone/Text/Filter.svg" />
            </span>
            Filter
          </a>

          <Dropdown1 />
          <!--end::Menu-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Button-->
        <a
          href="#"
          class="btn btn-sm btn-primary"
          data-bs-toggle="modal"
          data-bs-target="#kt_modal_create_app"
          id="kt_toolbar_primary_button"
        >
          Create
        </a>
        <!--end::Button-->
      </div>
      <!--end::Actions-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Toolbar-->
</template>

<script>
import Breadcrumbs from "resources/themes/base/Breadcrumbs";
import InlineSvg from "vue-inline-svg";
import Dropdown1 from "resources/themes/base/dropdown/Dropdown1";

export default {
  name: "ToolBar",
  components: {
    Breadcrumbs,
    InlineSvg,
    Dropdown1,
  }
}
</script>

<style scoped>

</style>
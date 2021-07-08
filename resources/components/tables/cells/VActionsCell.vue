<template>
  <div class="d-flex justify-content-end flex-shrink-0">
    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
      <!--begin::Svg Icon | path: icons/duotone/General/Settings-1.svg-->
      <span class="svg-icon svg-icon-3">
        <inline-svg src="/build/media/icons/duotone/General/Settings-1.svg" />
      </span>
      <!--end::Svg Icon-->
    </a>
    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
      <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
      <span class="svg-icon svg-icon-3">
        <inline-svg src="/build/media/icons/duotone/Communication/Write.svg" />
      </span>
      <!--end::Svg Icon-->
    </a>
    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
      <!--begin::Svg Icon | path: icons/duotone/General/Trash.svg-->
      <span class="svg-icon svg-icon-3">
        <inline-svg src="/build/media/icons/duotone/General/Trash.svg" />
      </span>
      <!--end::Svg Icon-->
    </a>
  </div>
</template>

<script>
import InlineSvg from "vue-inline-svg";

export default {
  name: "VActionsCell",
  components: {
    InlineSvg,
  }
}
</script>

<style scoped>

</style>
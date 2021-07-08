<template>
  <div class="d-flex align-items-center">
    <!--begin::Wrapper-->
    <div class="me-5 position-relative">
      <!--begin::Avatar-->
      <div class="symbol symbol-45px symbol-square">
        <img alt="Pic" src="/build/media/avatars/150-1.jpg" />
      </div>
      <!--end::Avatar-->
    </div>
    <!--end::Wrapper-->
    <!--begin::Info-->
    <div class="d-flex flex-column justify-content-center">
      <a href="" class="mb-1 text-gray-800 text-hover-primary">{{ value }}</a>
    </div>
    <!--end::Info-->
  </div>
</template>

<script>
export default {
  name: "VTitleCell",
  props: {
    value: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
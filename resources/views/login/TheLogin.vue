<template>
  <!--begin::Authentication - Sign-in -->
  <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-size: 100% 50%; background-image: url(build/media/misc/outdoor.png)">
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
      <!--begin::Logo-->
      <a href="/" class="mb-12">
        <img alt="Logo" src="build/media/logos/logo-2-dark.svg" class="h-45px" />
      </a>
      <!--end::Logo-->
      <!--begin::Wrapper-->
      <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
        <!--begin::Form-->
        <VLoginForm />
        <!--end::Form-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    <div class="d-flex flex-center flex-column-auto p-10">
      <!--begin::Links-->
      <div class="d-flex align-items-center fw-bold fs-6">
        <a href="https://keenthemes.com/faqs" class="text-muted text-hover-primary px-2">About</a>
        <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
        <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
      </div>
      <!--end::Links-->
    </div>
    <!--end::Footer-->
  </div>
  <!--end::Authentication - Sign-in-->
</template>

<script>
import VLoginForm from "resources/components/forms/VLoginForm";

export default {
  name: "TheLogin",
  components: {
    VLoginForm,
  }
}
</script>

<style lang="scss">
</style>
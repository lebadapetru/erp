<template>
  <div class="d-flex align-items-center">
    <!--begin::Wrapper-->
    <div class="me-5 position-relative">
      <!--begin::Avatar-->
      <div class="symbol symbol-45px symbol-square">
        <img alt="Pic" :src="avatarPath" />
      </div>
      <!--end::Avatar-->
    </div>
    <!--end::Wrapper-->
    <!--begin::Info-->
    <div class="d-flex flex-column justify-content-center">
      <a href="" class="mb-1 text-gray-800 text-hover-primary">{{ title }}</a>
    </div>
    <!--end::Info-->
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "VTitleCell",
  props: {
    title: {
      type: String,
      required: true
    },
    avatarPath: {
      type: String,
      required: false
    }
  },
  setup(props) {
    return {
    }
  }
})
</script>

<style scoped>

</style>
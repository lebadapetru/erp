<template>
  <!--begin::Alert-->
  <div :class="`alert alert-${type} alert-dismissible fade show d-flex align-items-center p-5 mb-10`">
    <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
      <inline-svg src="/build/media/icons/duotone/General/Shield-check.svg"></inline-svg>
    </span>
    <!--end::Svg Icon-->

    <!--begin::Wrapper-->
    <div class="d-flex flex-column">
      <!--begin::Title-->
      <h4 class="mb-1 text-dark">{{ title }}</h4>
      <!--end::Title-->
      <!--begin::Content-->
      <span>{{ content }}</span>
      <!--end::Content-->
      <!--begin::Close-->
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <!--end::Close-->
    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Alert-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import InlineSvg from 'vue-inline-svg'

export default defineComponent({
  name: "VFlashMessage",
  components: {
    InlineSvg
  },
  props: {
    title: {
      type: String,
      default: 'This is an alert',
    },
    content: {
      type: String,
      default: 'The alert component can be used to highlight certain parts of your page for higher content visibility.'
    },
    type: {
      type: String,
      default: 'success',
      validator(value: string) {
        // The value must match one of these strings
        return [
          'primary',
          'secondary',
          'success',
          'danger',
          'warning',
          'info',
          'light',
          'dark',
        ].includes(value)
      }
    }
  },
  setup () {
    return {

    }
  }
})
</script>

<style scoped>
.alert {
  position: fixed;
  left: 50%;
  transform: translateX(-50%);
  top: 5%;
  z-index: 9999;
}
</style>
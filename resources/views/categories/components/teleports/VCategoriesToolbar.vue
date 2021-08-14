<template>
  <teleport
    to="#toolbar_actions"
  >
    <span class="h-20px border-gray-200 border-start mx-4"></span>
    <!--begin::Search Form-->
    <span class="text-dark-50 fw-bold me-4">{{ totalCategories }} Total</span>
    <div class="me-auto">
      <!--begin::Menu-->
      <a
        href="#"
        class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
      >
            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
              <inline-svg src="/build/media/icons/duotone/Text/Filter.svg" />
            </span>
        Filter
      </a>

      <!--end::Menu-->
    </div>
    <!--end::Search Form-->
    <!--begin::Button-->
    <button
      type="button"
      class="btn btn-primary btn-sm fw-bold"
      data-bs-toggle="modal"
      data-bs-target="#kt_modal_1"
    >
      <i class="fas fa-plus"></i>
      Add Category
    </button>
    <!--end::Button-->
  </teleport>
</template>

<script lang="ts">
import InlineSvg from "vue-inline-svg";
import { useStore } from "vuex";
import { computed, defineComponent } from "vue";

export default defineComponent({
  name: "VProductsToolbar",
  components: {
    InlineSvg,
  },
  setup() {
    const store = useStore()

    return {
      totalCategories: computed(() => store.getters['categories/getTotalItems'])
    }
  }
})
</script>

<style scoped>
</style>
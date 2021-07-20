<template>
  <teleport
    to="#toolbar_actions"
  >
    <span class="h-20px border-gray-200 border-start mx-4"></span>
    <!--begin::Search Form-->
    <span class="text-dark-50 fw-bold me-4">{{ totalProducts }} Total</span>
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

<!--      <Dropdown1></Dropdown1>-->
      <!--end::Menu-->
    </div>
    <!--end::Search Form-->
    <!--begin::Button-->
    <router-link
      :to="{name: 'addProduct'}"
      class="btn btn-primary btn-sm fw-bold"
    >
      <i class="fas fa-plus"></i>
      Add Product
    </router-link>
    <!--end::Button-->
  </teleport>
</template>

<script>
import InlineSvg from "vue-inline-svg";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "VProductsToolbar",
  components: {
    InlineSvg,
  },
  setup() {
    const store = useStore()

    return {
      totalProducts: computed(() => store.getters['products/getTotalProducts'])
    }
  }
}
</script>

<style scoped>
</style>
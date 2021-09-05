<template>
  <teleport
    to="#toolbar_actions"
    v-if="isMounted"
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
      @click="showAddCategoryModal()"
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
import { computed, defineComponent, onMounted, ref } from "vue";

export default defineComponent({
  name: "VProductsToolbar",
  components: {
    InlineSvg,
  },
  setup() {
    const store = useStore()
    const isMounted = ref(false)
    onMounted(() => {
      isMounted.value = true
    })

    return {
      isMounted,
      totalCategories: computed(() => store.getters['categories/getTotalItems']),
      showAddCategoryModal: () => store.commit('modals/showAddCategoryModal'),
    }
  }
})
</script>

<style scoped>
</style>
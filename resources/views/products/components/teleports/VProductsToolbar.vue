<template>
  <teleport
    to="#toolbar_actions"
    v-if="isMounted"
  >
    <span class="h-20px border-gray-200 border-start mx-4"></span>
    <!--begin::Search Form-->
    <span class="text-dark-50 fw-bold me-4">{{ totalProducts }} Total</span>
    <ul class="nav nav-pills me-4 mb-2 mb-sm-0">
      <li class="nav-item m-0">
        <button
          class="btn btn-sm btn-icon btn-white btn-color-muted btn-active-primary me-3"
          @click="setGridView()"
          :class="{active: isGridView()}"
        >
          <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks-2.svg-->
          <span class="svg-icon svg-icon-2">
                <inline-svg src="/build/media/icons/duotone/Layout/Layout-4-blocks-2.svg" />
              </span>
          <!--end::Svg Icon-->
        </button>
      </li>
      <li class="nav-item m-0">
        <button
          class="btn btn-sm btn-icon btn-white btn-color-muted btn-active-primary"
          @click="setTableView()"
          :class="{active: isTableView()}"
        >
          <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-horizontal.svg-->
          <span class="svg-icon svg-icon-2">
                <inline-svg src="/build/media/icons/duotone/Layout/Layout-horizontal.svg" />
              </span>
          <!--end::Svg Icon-->
        </button>
      </li>
    </ul>

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

    const activeView = computed({
      get: (): string => store.getters['products/getActiveView'],
      set: (value: string) => store.commit('products/setActiveView', value),
    })

    return {
      isMounted,
      totalProducts: computed((): number => store.getters['products/getTotalItems']),
      isTableView: (): boolean => activeView.value === 'table',
      isGridView: (): boolean => activeView.value === 'grid',
      setTableView: () => activeView.value = 'table',
      setGridView: () => activeView.value = 'grid',
    }
  }
})
</script>

<style scoped>
</style>
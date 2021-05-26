<template>
  <!--begin::Pagination-->
  <div
    class="d-flex justify-content-between align-items-center flex-wrap"
    :class="styleClasses"
  >
    <div class="d-flex flex-wrap mr-3">
      <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
        <i class="ki ki-bold-double-arrow-back icon-xs"></i>
      </a>
      <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
        <i class="ki ki-bold-arrow-back icon-xs"></i>
      </a>

      <template
        v-for="page in pages"
        :key="page"
      >
        <a
          @click="activePage = page"
          href="javascript:;"
          class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1"
          :class="{ active: activePage === page }"
        >
          {{ page }}
        </a>
      </template>


      <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
        <i class="ki ki-bold-arrow-next icon-xs"></i>
      </a>
      <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
        <i class="ki ki-bold-double-arrow-next icon-xs"></i>
      </a>
    </div>
    <div class="d-flex align-items-center">
      <VBaseSelect
        :placeholder="''"
        :style-classes="'form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary'"
        style="width: 75px;"
        :name="'productsPerPage'"
        :options="itemsPerPage"
        v-model="productsPerPage"
      />
      <span class="text-muted">Displaying {{ productsPerPage }} of {{ totalProducts }} {{ label }}</span>
    </div>
  </div>
  <!--end::Pagination-->
</template>

<script>
import { useStore } from "vuex";
import { computed, watch } from "vue";
import VBaseSelect from "resources/components/forms/inputs/VBaseSelect";

export default {
  name: "VPagination",
  components: {
    VBaseSelect,
  },
  props: {
    styleClasses: {
      type: String,
      default: ''
    },
    label: {
      type: String,
      default: 'items'
    }
  },
  setup() {
    const store = useStore()

    const productsPerPage = computed({
        get: () => store.getters['product/getProductsPerPage'],
        set: (value) => store.commit('product/setProductsPerPage', value)
      }
    )

    const totalPages = Math.ceil(530 / productsPerPage.value)
    let pages = []
    for (let i = 1; i <= (totalPages < 10 ? totalPages : 10); i++) {
      pages.push(i)
    }

    let activePage = computed({
      get: () => store.getters['globals/getActivePage'],
      set: (value) => store.commit('globals/setActivePage', value)
    })

    watch(activePage, value => {
      if (value >= totalPages || value === 1) {
        return
      }
      let lastPage = pages.slice(-1)[0]
      let firstPage = pages[0]

      if (value === lastPage && value < totalPages) {
        for (let i = lastPage + 1; i <= ((lastPage + 4) >= totalPages ? totalPages : (lastPage + 4)); i++) {
          pages.push(i)
        }
        console.log(pages)
        if(pages.length < 10) {
          console.log('here')
          console.log((4-((lastPage+4)-totalPages)))
          pages.splice(0, (4-((lastPage+4)-totalPages)))
        } else {
          pages.splice(0, 4)
        }
      } else if (value === firstPage) {
        for (let i = firstPage - 1; i >= ((firstPage - 4) <= 1 ? 1 : (firstPage-4)); i--) {
          pages.unshift(i)
        }
        pages.splice(-4)
      }
    })
    return {
      itemsPerPage: store.getters['globals/getItemsPerPage'],
      productsPerPage,
      //totalProducts: computed(() => store.getters['product/getTotalProducts']),
      totalProducts: 530,
      pages,
      activePage,
    }
  }
}
</script>

<style scoped>

</style>
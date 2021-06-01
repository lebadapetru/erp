<template>
  <!--begin::Pagination-->
  <div
    class="d-flex justify-content-between align-items-center flex-wrap"
    :class="styleClasses"
  >
    <div class="d-flex flex-wrap mr-3">
      <button
        @click="activePage = 1"
        class="btn btn-icon btn-sm mr-2 my-1"
        :class="[(activePage === 1) ? 'btn-secondary' : 'btn-light-primary']"
        :disabled="activePage === 1"
      >
        <i class="ki ki-bold-double-arrow-back icon-xs"></i>
      </button>
      <button
        @click="activePage -= 1"
        class="btn btn-icon btn-sm mr-2 my-1"
        :class="[(activePage === 1) ? 'btn-secondary' : 'btn-light-primary']"
        :disabled="activePage === 1"
      >
        <i class="ki ki-bold-arrow-back icon-xs"></i>
      </button>

      <template
        v-for="page in pages"
        :key="page"
      >
        <button
          @click="activePage = page"
          class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1"
          :class="{ active: activePage === page }"
        >
          {{ page }}
        </button>
      </template>


      <button
        @click="activePage += 1"
        class="btn btn-icon btn-sm mr-2 my-1"
        :class="[(activePage >= totalPages) ? 'btn-secondary' : 'btn-light-primary']"
        :disabled="activePage >= totalPages"
      >
        <i class="ki ki-bold-arrow-next icon-xs"></i>
      </button>
      <button
        @click="activePage = totalPages"
        class="btn btn-icon btn-sm mr-2 my-1"
        :class="[(activePage >= totalPages) ? 'btn-secondary' : 'btn-light-primary']"
        :disabled="activePage >= totalPages"
      >
        <i class="ki ki-bold-double-arrow-next icon-xs"></i>
      </button>
    </div>
    <div class="d-flex align-items-center">
      <VBaseSelect
        :placeholder="''"
        :style-classes="'form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary'"
        style="width: 75px;"
        :name="'itemsPerPage'"
        :options="itemsPerPageOptions"
        v-model="itemsPerPage"
      />
      <span class="text-muted">
        Displaying {{ (itemsPerPage > totalItems) ? totalItems : itemsPerPage }} of {{ totalItems }} {{ label }} in {{ totalPages }} page{{ totalPages > 1 ? 's' : '' }}
      </span>
    </div>
  </div>
  <!--end::Pagination-->
</template>

<script>
import { useStore } from "vuex";
import { computed, ref, watch } from "vue";
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
    },
    totalItems: {
      type: Number,
      required: true
    }
  },
  setup(props) {
    let pages = ref([])
    const store = useStore()
    const itemsPerPage = computed({
        get: () => store.getters['globals/getItemsPerPage'],
        set: (value) => store.commit('globals/setItemsPerPage', value)
      }
    )
    const totalPages = computed(() => Math.ceil(props.totalItems / itemsPerPage.value))
    for (let i = 1; i <= (totalPages.value < 10 ? totalPages.value : 10); i++) {
      pages.value.push(i)
    }

    let activePage = computed({
      get: () => store.getters['globals/getActivePage'],
      set: (value) => store.commit('globals/setActivePage', value)
    })

    watch(activePage, value => {
      if (value >= totalPages.value || value === 1) {
        return
      }
      let lastPage = pages.value.slice(-1)[0]
      let firstPage = pages.value[0]

      //if selected page is the last element in array
      if (value === lastPage) {
        //add 4 more elements at the end of the array or as many as totalPages
        for (let i = lastPage + 1; i <= ((lastPage + 4) >= totalPages.value ? totalPages.value : (lastPage + 4)); i++) {
          pages.value.push(i)
        }
        //keep the last 10 elements of the array and remove the rest
        pages.value.reverse().splice(10)
        pages.value.reverse()
      //if selected page is the first element in array
      } else if (value === firstPage) {
        //add 4 more elements at the start of the array or until it reaches 1
        for (let i = firstPage - 1; i >= ((firstPage - 4) <= 1 ? 1 : (firstPage-4)); i--) {
          pages.value.unshift(i)
        }
        //keep the first 10 elements of the array and remove the rest
        pages.value.splice(10)
      }
    })

    watch(itemsPerPage, () => {
      pages.value = []
      for (let i = 1; i <= (totalPages.value < 10 ? totalPages.value : 10); i++) {
        pages.value.push(i)
      }

      activePage.value = 1
    })

    return {
      itemsPerPageOptions: store.getters['globals/getItemsPerPageOptions'],
      itemsPerPage,
      totalPages,
      pages,
      activePage,
    }
  }
}
</script>

<style scoped>

</style>
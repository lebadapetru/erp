<template>
  <div class="card" :class="styleClasses">
    <div class="card-body row">
      <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-start">
        <div>
          <ul class="pagination">
            <li class="page-item previous disabled">
              <a
                href="javascript:;"
                tabindex="0"
                class="page-link"
              >
                <i class="previous"></i>
              </a>
            </li>
            <li class="page-item previous disabled">
              <a
                href="javascript:;"
                tabindex="0"
                class="page-link"
              >
                <i class="fas fa-angle-left"></i>
              </a>
            </li>
            <template
              v-for="page in pages"
              :key="page"
            >
              <li
                class="page-item active"
                :class="{ active: activePage === page }"
              >
                <a
                  href="javascript:;"
                  tabindex="0"
                  class="page-link"
                  @click="activePage = page"
                >
                  {{ page }}
                </a>
              </li>
            </template>
            <li class="page-item next">
              <a
                href="javascript:;"
                tabindex="0"
                class="page-link"
              >
                <i class="next"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-end">
        <div class="me-3">
          <VBaseSelect
            :placeholder="''"
            :select-style-classes="'form-select form-select-sm form-select-solid'"
            style="width: 75px;"
            :name="'itemsPerPage'"
            :options="itemsPerPageOptions"
            v-model="itemsPerPage"
          />
        </div>
        <div role="status" aria-live="polite">
          <span class="text-muted">
            Displaying {{ (itemsPerPage > totalItems) ? totalItems : itemsPerPage }} of {{ totalItems }} {{ label }} in {{ totalPages }} page{{ totalPages > 1 ? 's' : '' }}
          </span>
        </div>
      </div>
    </div>
  </div>

  <div
    class="card card-custom"
  >
    <div class="card-body py-5">
      <!--begin::Pagination-->
      <div
        class="d-flex justify-content-between align-items-center flex-wrap"
      >
        <div class="d-flex flex-wrap mr-3">
          <button
            @click="activePage = 1"
            class="btn btn-icon btn-sm mr-2 my-1"
            :class="[(activePage === 1) ? 'btn-secondary' : 'btn-light-primary']"
            :disabled="activePage === 1"
          >
            <i class="fas fa-angle-double-left"></i>
          </button>
          <button
            @click="activePage -= 1"
            class="btn btn-icon btn-sm mr-2 my-1"
            :class="[(activePage === 1) ? 'btn-secondary' : 'btn-light-primary']"
            :disabled="activePage === 1"
          >
            <i class="fas fa-angle-left"></i>
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
            <i class="fas fa-angle-right"></i>
          </button>
          <button
            @click="activePage = totalPages"
            class="btn btn-icon btn-sm mr-2 my-1"
            :class="[(activePage >= totalPages) ? 'btn-secondary' : 'btn-light-primary']"
            :disabled="activePage >= totalPages"
          >
            <i class="fas fa-angle-double-right"></i>
          </button>
        </div>
        <div class="d-flex align-items-center">
          <ul class="nav nav-pills me-6 mr-3 mb-sm-0">
            <li class="nav-item m-0">
              <button
                @click="activeView = 'grid'"
                class="btn btn-icon btn-sm border-0 btn-hover-primary"
                :class="{active: (activeView === 'grid')}"
              >
                <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks-2.svg-->
                <span class="svg-icon svg-icon-lg">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"></rect>
																<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
																<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
																<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
															</g>
														</svg>
													</span>
                <!--end::Svg Icon-->
              </button>
            </li>
            <li class="nav-item m-0">
              <button
                @click="activeView = 'table'"
                class="btn btn-icon btn-sm border-0 btn-hover-primary"
                :class="{active: (activeView === 'table')}"
              >
                <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-horizontal.svg-->
                <span class="svg-icon svg-icon-lg">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24"></rect>
																<rect fill="#000000" opacity="0.3" x="4" y="5" width="16" height="6" rx="1.5"></rect>
																<rect fill="#000000" x="4" y="13" width="16" height="6" rx="1.5"></rect>
															</g>
														</svg>
													</span>
                <!--end::Svg Icon-->
              </button>
            </li>
          </ul>
          <VBaseSelect
            :placeholder="''"
            :select-style-classes="'form-select form-select-sm form-select-solid'"
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
    </div>
  </div>

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
      activeView: computed({
        get: () => store.getters['products/getActiveView'],
        set: (value) => store.commit('products/setActiveView', value),
      }),
    }
  }
}
</script>

<style scoped>

</style>
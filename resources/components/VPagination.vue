<template>
  <div class="card" :class="styleClasses">
    <div class="card-body row">
      <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-start">
        <div>
          <ul class="pagination">
            <li
              class="page-item previous"
              :class="{disabled: isFirstPage()}"
              @click="setActivePageToFirst()"
            >
              <button
                tabindex="0"
                class="page-link"
                :disabled="isFirstPage()"
              >
                <i class="fas fa-angle-double-left"></i>
              </button>
            </li>
            <li
              class="page-item previous"
              :class="{disabled: isFirstPage()}"
              @click="previousPage()"
            >
              <button
                tabindex="0"
                class="page-link"
                :disabled="isFirstPage()"
              >
                <i class="fas fa-angle-left"></i>
              </button>
            </li>
            <template
              v-for="page in pages"
              :key="page"
            >
              <li
                class="page-item"
                :class="{ active: isActivePage(page) }"
                @click="setActivePage(page)"
              >
                <button
                  tabindex="0"
                  class="page-link"
                >
                  {{ page }}
                </button>
              </li>
            </template>
            <li
              class="page-item next"
              :class="{disabled: isLastPage()}"
              @click="nextPage()"
            >
              <button
                tabindex="0"
                class="page-link"
                :disabled="isLastPage()"
              >
                <i class="fas fa-angle-right"></i>
              </button>
            </li>
            <li
              class="page-item next"
              :class="{disabled: isLastPage()}"
              @click="setActivePageToLast()"
            >
              <button
                tabindex="0"
                class="page-link"
                :disabled="isLastPage()"
              >
                <i class="fas fa-angle-double-right"></i>
              </button>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-end">
        <div class="me-3">
          <VBaseSelect
            :placeholder="''"
            :select-style-classes="'form-select form-select-sm form-select-solid'"
            :name="'itemsPerPage'"
            :options="itemsPerPageOptions"
            v-model="itemsPerPage"
          />
        </div>
        <div role="status" aria-live="polite">
          <span class="text-muted">
            Displaying {{ (itemsPerPage > totalItems) ? totalItems : itemsPerPage }} of {{ totalItems }} {{ label }} in {{
              totalPages
            }} page{{ totalPages > 1 ? 's' : '' }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { useStore } from "vuex";
import { computed, defineComponent, ref, watch } from "vue";
import VBaseSelect from "resources/components/forms/inputs/VBaseSelect.vue";
import InlineSvg from "vue-inline-svg";

export default defineComponent({
  name: "VPagination",
  components: {
    VBaseSelect,
    InlineSvg,
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
    },
    module: {
      type: String,
      required: true
    }
  },
  setup(props) {
    let pages = ref([])
    const store = useStore()
    const itemsPerPage = computed({
        get: () => store.getters[props.module + '/getItemsPerPage'],
        set: (value) => store.commit(props.module + '/setItemsPerPage', value)
      }
    )
    const totalPages = computed(() => Math.ceil(props.totalItems / itemsPerPage.value))
    for (let i = 1; i <= (totalPages.value < 10 ? totalPages.value : 10); i++) {
      pages.value.push(i)
    }

    let activePage = computed({
      get: () => store.getters[props.module + '/getActivePage'],
      set: (value) => store.commit(props.module + '/setActivePage', value)
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
        for (let i = firstPage - 1; i >= ((firstPage - 4) <= 1 ? 1 : (firstPage - 4)); i--) {
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

    const setActivePage = (value) => activePage.value = value

    return {
      itemsPerPageOptions: store.getters[props.module + '/getItemsPerPageOptions'],
      itemsPerPage,
      totalPages,
      pages,
      activePage,
      previousPage: () => activePage.value -= 1,
      nextPage: () => activePage.value += 1,
      isActivePage: (value) => activePage.value === value,
      isFirstPage: () => activePage.value === 1,
      isLastPage: () => activePage.value >= totalPages.value,
      setActivePage,
      setActivePageToFirst: () => setActivePage(1),
      setActivePageToLast: () => setActivePage(totalPages.value),
    }
  }
})
</script>

<style scoped>

</style>
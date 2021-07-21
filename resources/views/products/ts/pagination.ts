import { useStore } from "vuex";
import { computed, watch } from "vue";

const usePagination = (module: string) => {
  const store = useStore()

  let activePage = computed(() => store.getters[module + '/getActivePage'])
  let itemsPerPage = computed(() => store.getters[module + '/getItemsPerPage'])

  store.dispatch(module + '/readItems', {
    page: activePage.value,
    itemsPerPage: itemsPerPage.value
  })
  const totalItems = computed(() => store.getters[module + '/getTotalItems'])

  //TODO this gets triggered twice, find a way to trigger when value = initial state
  watch([activePage, itemsPerPage], ([page, itemsPerPage]) => {
    store.dispatch(module + '/readItems', {
      page,
      itemsPerPage
    })
  })

  return {
    totalItems,
  }
}

export { usePagination }
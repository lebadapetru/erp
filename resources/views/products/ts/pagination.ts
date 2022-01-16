import { useStore } from "vuex";
import { computed, watch } from "vue";
import { onBeforeRouteUpdate } from "vue-router";

const usePagination = (module: string) => {
  const store = useStore()

  let activePage = computed(() => store.getters[module + '/getActivePage'])
  let itemsPerPage = computed(() => store.getters[module + '/getItemsPerPage'])
  console.log('usePagination')
  store.dispatch(module + '/read', {
    page: activePage.value,
    itemsPerPage: itemsPerPage.value
  })

  onBeforeRouteUpdate((to, from, next) => {
    console.log('onBeforeRouteUpdate')
    if (to.meta?.isListing) {
      console.log('isListing')
      store.dispatch(module + '/read', {
        page: activePage.value,
        itemsPerPage: itemsPerPage.value
      })
    }

    next()
  })

  const totalItems = computed(() => store.getters[module + '/getTotalItems'])

  //TODO this gets triggered twice, find a way to trigger when value = initial state
  watch([activePage, itemsPerPage], ([page, itemsPerPage]) => {
    store.dispatch(module + '/read', {
      page,
      itemsPerPage
    })
  })

  return {
    totalItems,
  }
}

export { usePagination }
import { useStore } from "vuex";
import { computed, watch } from "vue";

const usePagination = () => {
  const store = useStore()

  let activePage = computed(() => store.getters['globals/getActivePage'])
  let itemsPerPage = computed(() => store.getters['globals/getItemsPerPage'])

  store.dispatch('products/readProducts', {
    page: activePage.value,
    itemsPerPage: itemsPerPage.value
  })
  const totalProducts = computed(() => store.getters['products/getTotalProducts'])

  //TODO this gets triggered twice, find a way to trigger when value = initial state
  watch([activePage, itemsPerPage], ([page, itemsPerPage]) => {
    store.dispatch('products/readProducts', {
      page,
      itemsPerPage
    })
  })

  return {
    totalProducts,
  }
}

export { usePagination }
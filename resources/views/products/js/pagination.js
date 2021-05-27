import { useStore } from "vuex";
import { computed, watch } from "vue";

const usePagination = () => {
  const store = useStore()

  let activePage = computed(() => store.getters['globals/getActivePage'])
  let itemsPerPage = computed(() => store.getters['globals/getItemsPerPage'])

  store.dispatch('product/readAndParseProducts', {
    page: activePage.value,
    itemsPerPage: itemsPerPage.value
  })
  const totalProducts = computed(() => store.getters['product/getTotalProducts'])

  //TODO this gets triggered twice, find a way to trigger when value = initial state
  watch([activePage, itemsPerPage], (page) => {
    console.log('products pagination')
    console.log(page)
    console.log(itemsPerPage)
    store.dispatch('product/readAndParseProducts', {
      page,
      itemsPerPage: itemsPerPage.value
    })
  })

  return {
    totalProducts,
  }
}

export { usePagination }
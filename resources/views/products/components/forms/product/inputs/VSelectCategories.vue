<template>
  <VSelect2
      :name="'categories'"
      :placeholder="`Search for categories`"
      :has-tags="true"
      :has-multiple="true"
      :options="categoryOptions"
      :item-title="`category`"
      :add-item-callback="parseAndCreateCategoryOption"
      @item-added="readAndParseCategoryOptions()"
  />
</template>

<script>
import VSelect2 from "resources/components/forms/inputs/VSelect2";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "VSelectCategories",
  components: {
    VSelect2
  },
  setup() {
    const store = useStore()

    let readAndParseCategoryOptions = () => {
      store.dispatch("product/readAndParseCategoryOptions")
    }
    readAndParseCategoryOptions()

    let parseAndCreateCategoryOption = async (category) => {
      await store.dispatch("product/parseAndCreateCategoryOption", category)
    }

    let categoryOptions = computed(() => store.getters["product/getCategoryOptions"])

    console.log('select categories')
    console.log(categoryOptions)

    return {
      categories: computed({
        get: () => store.getters["product/getCategories"],
        set: (value) => store.commit("product/setCategories", value),
      }),
      readAndParseCategoryOptions,
      parseAndCreateCategoryOption,
      categoryOptions: categoryOptions,
    }
  }
}
</script>

<style scoped>

</style>
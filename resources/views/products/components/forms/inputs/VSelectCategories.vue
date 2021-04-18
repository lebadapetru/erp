<template>
  <VSelect2
      v-if="categories"
      :placeholder="`Search for categories`"
      :has-tags="true"
      :has-multiple="true"
      :options="categories"
      :item-title="`category`"
      :add-item-callback="parseAndCreateCategories"
      @item-added="readAndParseCategories()"
  />
</template>

<script>
import VSelect2 from "resources/components/forms/inputs/VSelect2";
import { useCategoryRepository } from "resources/js/repository/CategoryRepository"
import { reactive, toRefs } from 'vue'

export default {
  name: "VSelectCategories",
  components: {
    VSelect2
  },
  setup() {
    const state = reactive({
      categories: []
    })

    const { readCategories, createCategory } = useCategoryRepository()

    const readAndParseCategories = () => {
      readCategories().then((categories) => {
        state.categories = categories.map(category => ({
          id: category.id,
          text: category.title,
        }))
      })
    }
    readAndParseCategories()

    const parseAndCreateCategories = (category) => {
      return createCategory({
        title: category?.text
      })
    }

    return {
      ...toRefs(state),
      parseAndCreateCategories,
      readAndParseCategories
    }
  }
}
</script>

<style scoped>

</style>
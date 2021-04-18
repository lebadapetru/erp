<template>
  <VSelect2
    v-if="tags"
    :placeholder="`Search for tags`"
    :has-tags="true"
    :has-multiple="true"
    :options="tags"
    :item-title="`tag`"
    :add-item-callback="parseAndCreateTags"
    @item-added="readAndParseTags()"
  />
</template>

<script>
import VSelect2 from "resources/components/forms/inputs/VSelect2";
import { useTagRepository } from "resources/js/repository/TagRepository"
import { reactive, toRefs } from 'vue'

export default {
  name: "VSelectTags",
  components: {
    VSelect2
  },
  setup() {
    const state = reactive({
      tags: []
    })

    const { readTags, createTag } = useTagRepository()

    const readAndParseTags = () => {
      readTags().then((tags) => {
        state.tags = tags.map(tag => ({
          id: tag.id,
          text: tag.title,
        }))
      })
    }
    readAndParseTags()

    const parseAndCreateTags = (tag) => {
      return createTag({
        title: tag?.text
      })
    }

    return {
      ...toRefs(state),
      parseAndCreateTags,
      readAndParseTags
    }
  }
}
</script>

<style scoped>

</style>
<template>
<!--  <VSelect2
    v-if="tagOptions"
    :name="'tags'"
    :placeholder="`Search for tags`"
    :has-tags="true"
    :has-multiple="true"
    :options="tagOptions"
    :item-title="`tag`"
    :add-item-callback="parseAndCreateTagOption"
    @item-added="readAndParseTagOptions()"
  />-->
  <VMultiSelect />
</template>

<script>
import VSelect2 from "resources/components/forms/inputs/VSelect2";
import VMultiSelect from "resources/components/forms/inputs/VMultiSelect";
import { computed } from 'vue'
import { useStore } from "vuex";

export default {
  name: "VSelectTags",
  components: {
    VSelect2,
    VMultiSelect,
  },
  setup() {
    const store = useStore()

    let readAndParseTagOptions = () => {
      store.dispatch("product/readAndParseTagOptions")
    }
    readAndParseTagOptions()

    let parseAndCreateTagOption = async (category) => {
      await store.dispatch("product/parseAndCreateTagOption", category)
    }

    return {
      tagOptions: computed(() => store.getters["product/getTagOptions"]),
      tags: computed({
        get: () => store.getters["product/getTags"],
        set: (value) => store.commit("product/setTags", value),
      }),
      readAndParseTagOptions,
      parseAndCreateTagOption,
    }
  }
}
</script>

<style scoped>

</style>
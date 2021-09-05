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

<script lang="ts">
import VMultiSelect from "resources/components/forms/inputs/VMultiSelect.vue";
import { computed, defineComponent } from 'vue'
import { useStore } from "vuex";

export default defineComponent({
  name: "VSelectTags",
  components: {
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
})
</script>

<style scoped>

</style>
<template>
  <VSelect2
    v-if="variantOptions"
    :name="'variantOptions'"
    :label="'Option 1'"
    :options="variantOptions"
    :placeholder="`Search for variants`"
    :has-tags="true"
    :item-title="`variantOption`"
    :add-item-callback="parseAndCreateVariantOption"
    @item-added="readAndParseVariantOptions()"
  />
<!-- TODO  @variant-option-added might not need a custom event emit since only the parent listen to it -->
<!-- TODO  @variant-option-added renders the component and the new added item it's no longer selected -->
<!-- TODO  save the selected item in vuex -->
</template>

<script>
import VSelect2 from "resources/components/forms/inputs/VSelect2";
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  name: "VSelectVariantOptions",
  components: {
    VSelect2
  },
  setup() {
    const store = useStore()

    let readAndParseVariantOptions = () => {
      store.dispatch("product/readAndParseVariantOptions")
    }
    readAndParseVariantOptions()

    let variantOptions = computed(() => store.getters["product/getVariantOptions"])

    let parseAndCreateVariantOption = async (variant) => {
      await store.dispatch("product/parseAndCreateVariantOption", variant)
    }

    return {
      variantOptions,
      readAndParseVariantOptions,
      parseAndCreateVariantOption
    }
  }
}
</script>

<style scoped>

</style>
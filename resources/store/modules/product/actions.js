import { createVariantOption, readVariantOptions } from "resources/js/api/variantOption"

const actions = {
  readAndParseVariantOptions: ({ commit }) => {
    return readVariantOptions().then((response) => {
      let variantOptions = response.data.map(variantOption => ({
        id: variantOption.id,
        text: variantOption.name,
      }))

      commit('setVariantOptions', variantOptions)
    })
  },
  parseAndCreateVariantOption: async ({}, variant) => {
    return await createVariantOption({
      name: variant.text
    })
  }
}

export default actions
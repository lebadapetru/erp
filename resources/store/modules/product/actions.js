import { createVariantOption, readVariantOptions } from "resources/js/api/VariantOption"
import { readLookupProductStatus } from "resources/js/api/LookupProductStatus";
import { readVendor } from "resources/js/api/Vendors";

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
    /*TODO maybe after creation, directly update the state? */
    return await createVariantOption({
      name: variant.text
    })
  },
  readAndParseLookupProductStatus: ({ commit }) => {
    return readLookupProductStatus().then((response) => {
      let statusOptions = response.data.map(statusOption => ({
        value: statusOption.id,
        label: statusOption.name,
      }))

      commit('setStatusOptions', statusOptions)
    })
  },
  readAndParseVendorOptions: ({ commit }) => {
    return readVendor().then((response) => {
      let vendorOptions = response.data.map(vendorOption => ({
        value: vendorOption.id,
        label: vendorOption.name,
      }))

      commit('setVendorOptions', vendorOptions)
    })
  }
}

export default actions
import { createVariantOption, readVariantOptions } from "resources/js/api/VariantOption"
import { readLookupProductStatuses } from "resources/js/api/LookupProductStatus";
import { readVendors } from "resources/js/api/Vendor";
import { createCategory, readCategories } from "resources/js/api/Category";
import { createTag, readTags } from "resources/js/api/Tag";
import { createProduct, readProduct, deleteProduct, updateProduct } from "resources/js/api/Product";
import { deleteFile } from "resources/js/api/File";
import Swal from "sweetalert2";

const actions = {
  readAndParseVariantOptions: ({ commit }) => {
    return readVariantOptions().then((response) => {
      let variantOptions = response.data['hydra:member'].map(variantOption => ({
        id: variantOption['@id'],
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
    return readLookupProductStatuses().then((response) => {
      let statusOptions = response.data['hydra:member'].map(statusOption => ({
        value: statusOption['@id'],
        label: statusOption.name,
      }))

      commit('setStatusOptions', statusOptions)
    })
  },
  readAndParseVendorOptions: ({ commit }) => {
    return readVendors().then((response) => {
      let vendorOptions = response.data['hydra:member'].map(vendorOption => ({
        value: vendorOption['@id'],
        label: vendorOption.name,
      }))

      commit('setVendorOptions', vendorOptions)
    })
  },
  readAndParseCategoryOptions: ({ commit }) => {
    readCategories().then((response) => {
      let categoryOptions = response.data['hydra:member'].map(categoryOption => ({
        id: categoryOption['@id'],
        text: categoryOption.title,
      }))

      commit('setCategoryOptions', categoryOptions)
    })
  },
  parseAndCreateCategoryOption: async ({}, category) => {
    /*TODO maybe after creation, directly update the state? */
    return await createCategory({
      title: category.text
    })
  },
  readAndParseTagOptions: ({ commit }) => {
    readTags().then((response) => {
      let tagOptions = response.data['hydra:member'].map(tagOption => ({
        id: tagOption['@id'],
        text: tagOption.name,
      }))

      commit('setTagOptions', tagOptions)
    })
  },
  parseAndCreateTagOption: async ({}, tag) => {
    /*TODO maybe after creation, directly update the state? */
    return await createTag({
      name: tag.text
    })
  },
  readProduct: ({ state, commit }, id) => {
    return readProduct(id).then((response) => {
      commit('setProduct', response.data)
    })
  },
  createProduct: ({}, data) => {
    createProduct(data).then(() => {
      Swal.fire({
        text: 'The product has been created!',
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
          confirmButton: "btn font-weight-bold btn-light-primary"
        },
        heightAuto: false
      }).then(() => {
        //TODO based on the submit type, redirect or do something else
      })
    })
  },
  updateProduct: ({}, data) => {
    updateProduct(data).then(() => {
      Swal.fire({
        text: 'The product has been updated!',
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
          confirmButton: "btn font-weight-bold btn-light-primary"
        },
        heightAuto: false
      }).then(() => {
        //TODO based on the submit type, redirect or do something else
      })
    })
  },
  deleteProduct: ({ state}, id) => {
    return deleteProduct(id)
  },
  deleteFile: ({ state, commit }, id) => {
    return deleteFile(id)
  }
}

export default actions
let mutations = {
  setProduct: undefined,
  setId: (state, value) => state.id = value,
  setTitle: (state, value) => state.title = value,
  setDescription: (state, value) => state.description = value,
  setProductFiles: (state, value) => state.productFiles = value,
  setOriginalPrice: (state, value) => state.originalPrice = value,
  setReducedPrice: (state, value) => state.reducedPrice = value,
  setDiscount: (state, value) => state.discount = value,
  setSku: (state, value) => state.sku = value,
  setBarcode: (state, value) => state.barcode = value,
  setIsTrackQuantity: (state, value) => state.isTrackQuantity = value,
  setIsContinueSellingOutOfStock: (state, value) => state.isContinueSellingOutOfStock = value,
  setQuantity: (state, value) => state.quantity = value,
  setIsPhysicalProduct: (state, value) => state.isPhysicalProduct = value,
  setWeight: (state, value) => state.weight = value,
  setHasVariants: (state, value) => state.hasVariants = value,
  setVariantOptions: (state, value) => state.variantOptions = value,
  setIsPublic: (state, value) => state.isPublic = value,
  setStatusOptions: (state, value) => state.statusOptions = value,
  setStatus: (state, value) => state.status = value,
  setVendorOptions: (state, value) => state.vendorOptions = value,
  setVendor: (state, value) => state.vendor = value,
  setCategoryOptions: (state, value) => state.categoryOptions = value,
  setCategories: (state, value) => state.categories = value,
  setTagOptions: (state, value) => state.tagOptions = value,
  setTags: (state, value) => state.tags = value,
  resetState: (state) => Object.assign(state, state.defaultState),
}

mutations.setProduct = (state, value) => {
  mutations.setId(state, value.id)
  mutations.setTitle(state, value.title)
  mutations.setDescription(state, value.description)
  //TODO media
  mutations.setProductFiles(state, value.productFiles)
  mutations.setOriginalPrice(state, value.originalPrice)
  mutations.setReducedPrice(state, value.reducedPrice)
  mutations.setDiscount(state, value.discount)
  mutations.setSku(state, value.sku)
  mutations.setBarcode(state, value.barcode)
  mutations.setIsTrackQuantity(state, value.isTrackQuantity)
  mutations.setIsContinueSellingOutOfStock(state, value.isContinueSellingOutOfStock)
  mutations.setIsPhysicalProduct(state, value.isPhysicalProduct)
  mutations.setWeight(state, value.weight)
  mutations.setHasVariants(state, value.hasVariants)
  mutations.setIsPublic(state, value.isPublic)
  mutations.setStatus(state, value.status['@id'])
  mutations.setVendor(state, value.vendor)
  mutations.setCategories(state, value.categories)
  mutations.setTags(state, value.tags)
}

export default mutations
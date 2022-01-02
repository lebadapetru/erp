let mutations = {
  setProduct: undefined,
  setId: (state, value) => state.entity.id = value,
  setTitle: (state, value) => state.entity.title = value,
  setDescription: (state, value) => state.entity.description = value,
  setOriginalPrice: (state, value) => state.entity.originalPrice = value,
  setReducedPrice: (state, value) => state.entity.reducedPrice = value,
  setDiscount: (state, value) => state.entity.discount = value,
  setSku: (state, value) => state.entity.sku = value,
  setBarcode: (state, value) => state.entity.barcode = value,
  setIsTrackQuantity: (state, value) => state.entity.isTrackQuantity = value,
  setIsContinueSellingOutOfStock: (state, value) => state.entity.isContinueSellingOutOfStock = value,
  setQuantity: (state, value) => state.entity.quantity = value,
  setIsPhysicalProduct: (state, value) => state.entity.isPhysicalProduct = value,
  setWeight: (state, value) => state.entity.weight = value,
  setHasVariants: (state, value) => state.entity.hasVariants = value,
  setIsPublic: (state, value) => state.entity.isPublic = value,
  setStatus: (state, value) => state.entity.status = value,
  setVendor: (state, value) => state.entity.vendor = value,
  setCategories: (state, value) => state.entity.categories = value,
  setTags: (state, value) => state.entity.tags = value,
  setProductFiles: (state, value) => state.entity.productFiles = value,
  setFiles: (state, value) => state.files = value,
  setVariantOptions: (state, value) => state.variantOptions = value,
  setVendorOptions: (state, value) => state.vendorOptions = value,
  setStatusOptions: (state, value) => state.statusOptions = value,
  setCategoryOptions: (state, value) => state.categoryOptions = value,
  setTagOptions: (state, value) => state.tagOptions = value,
  resetState: (state) => Object.assign(state.entity, state.defaultState),
}

mutations.setProduct = (state, product) => {
  mutations.setId(state, product.id)
  mutations.setTitle(state, product.title)
  mutations.setDescription(state, product.description)
  mutations.setOriginalPrice(state, product.originalPrice)
  mutations.setReducedPrice(state, product.reducedPrice)
  mutations.setDiscount(state, product.discount)
  mutations.setSku(state, product.sku)
  mutations.setBarcode(state, product.barcode)
  mutations.setIsTrackQuantity(state, product.isTrackQuantity)
  mutations.setIsContinueSellingOutOfStock(state, product.isContinueSellingOutOfStock)
  mutations.setIsPhysicalProduct(state, product.isPhysicalProduct)
  mutations.setWeight(state, product.weight)
  mutations.setHasVariants(state, product.hasVariants)
  mutations.setIsPublic(state, product.isPublic)
  mutations.setStatus(state, product.status['@id'])
  mutations.setVendor(state, product.vendor)
  mutations.setCategories(state, product.categories)
  mutations.setTags(state, product.tags)
  mutations.setProductFiles(state, product.productFiles)
}

export default mutations
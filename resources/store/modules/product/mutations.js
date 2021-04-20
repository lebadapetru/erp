const mutations = {
  setTitle: (state, value) => state.title = value,
  setDescription: (state, value) => state.description = value,
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
}


export default mutations
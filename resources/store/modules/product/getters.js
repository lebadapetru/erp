const getters = {
  getTitle: (state) => state.title,
  getDescription: (state) => state.description,
  getOriginalPrice: (state) => state.originalPrice,
  getReducedPrice: (state) => state.reducedPrice,
  getDiscount: (state) => state.discount,
  getSku: (state) => state.sku,
  getBarcode: (state) => state.barcode,
  getIsTrackQuantity: (state) => state.isTrackQuantity,
  getIsContinueSellingOutOfStock: (state) => state.isContinueSellingOutOfStock,
  getQuantity: (state) => state.quantity,
  getIsPhysicalProduct: (state) => state.isPhysicalProduct,
  getWeight: (state) => state.weight,
  getHasVariants: (state) => state.hasVariants,
  getVariantOptions: (state) => state.variantOptions,
  getIsPublic: (state) => state.isPublic,
}

export default getters
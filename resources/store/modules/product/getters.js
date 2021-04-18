const getters = {
  getTitle: (state) => state.title,
  getDescription: (state) => state.description,
  getOriginalPrice: (state) => state.originalPrice,
  getReducedPrice: (state) => state.reducedPrice,
  getDiscount: (state) => state.discount,
}

export default getters
const state = () => ({
  title: '',
  description: '',
  originalPrice: 0,
  reducedPrice: 0,
  discount: 0,
  sku: '',
  barcode: '',
  isTrackQuantity: true,
  isContinueSellingOutOfStock: false,
  quantity: 0,
  isPhysicalProduct: true,
  weight: 0,
  measurementUnit: 1,
  //TODO add a setting to let user choose the measurement system
  //create a table for them
  measurementUnits: [
    {
      label: 'kg',
      value: 1
    },
    {
      label: 'g',
      value: 2
    }
  ],
  hasVariants: false,
  variantOptions: [],
  variants: [
    {}
  ],
  isPublic: true,
  vendors: [],
  vendor: '',
  categories: [],
  tags: [],
})

export default state

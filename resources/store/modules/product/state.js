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
  hasVariants: false,
  variantOptions: [],
  variants: [],
  isPublic: true,
  statusOptions: [],
  status: 1,
  vendorOptions: [],
  vendor: 1,
  categoryOptions: [],
  categories: [],
  tagOptions: [],
  tags: [],
  files: []
})

export default state

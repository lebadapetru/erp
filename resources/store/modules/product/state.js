const defaultState = {
  id: null,
  title: '',
  description: '',
  originalPrice: '0',
  reducedPrice: '0',
  discount: 0,
  sku: '',
  barcode: '',
  isTrackQuantity: true,
  isContinueSellingOutOfStock: false,
  quantity: 0,
  isPhysicalProduct: true,
  weight: 0,
  hasVariants: false,
  variants: [],
  isPublic: true,
  status: '/api/lookup_product_statuses/1',
  vendor: '/api/vendors/1',
  categories: [],
  tags: [],
  files: [],
}
const state = {
  defaultState: Object.freeze(defaultState),
  ...defaultState,
  variantOptions: [],
  statusOptions: [],
  vendorOptions: [],
  categoryOptions: [],
  tagOptions: [],
}

export default state

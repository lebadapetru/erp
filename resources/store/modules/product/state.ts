const defaultState = {
  id: null,
  title: '',
  description: '',
  originalPrice: '0.00',
  reducedPrice: '0.00',
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
  productFiles: [],
}

const state = {
  entity: {...defaultState},
  defaultState: Object.freeze(defaultState),
  variantOptions: [],
  statusOptions: [],
  vendorOptions: [],
  categoryOptions: [],
  tagOptions: [],
  files: []
}

export default state

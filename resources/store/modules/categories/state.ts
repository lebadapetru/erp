const state = {
  items: [],
  totalItems: 0,
  selectedItems: [],
  pagination: {
    activePage: 1,
    itemsPerPageOptions: [
      { label: 1, value: 1 },
      { label: 2, value: 2 },
      { label: 3, value: 3 },
      { label: 16, value: 16 },
      { label: 24, value: 24 },
      { label: 32, value: 32 },
      { label: 40, value: 40 },
    ],
    itemsPerPage: 16,
  },
  modals: {
    addCategory: false,
    editCategory: false,
  }
}

export default state

const state = () => ({
  addCategory: false,
  editCategory: false,
})

const getters = {
  isAddCategoryModalVisible: (state): boolean => state.addCategory,
  isEditCategoryModalVisible: (state): boolean => state.editCategory,
}

const mutations = {
  hideAddCategoryModal: (state) => state.addCategory = false,
  hideEditCategoryModal: (state) => state.editCategory = false,
  showAddCategoryModal: (state) => state.addCategory = true,
  showEditCategoryModal: (state) => state.editCategory = true,
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
}
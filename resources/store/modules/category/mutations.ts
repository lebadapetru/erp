let mutations = {
  setId: (state, value) => state.id = value,
  setTitle: (state, value) => state.title = value,
  setDescription: (state, value) => state.description = value,
  setIsPublic: (state, value) => state.isPublic = value,
  setCategory: undefined,
  resetState: (state) => Object.assign(state, state.defaultState)
}

mutations.setCategory = (state, data) => {
  mutations.setId(state, data.id)
  mutations.setTitle(state, data.title)
  mutations.setDescription(state, data.description)
  mutations.setIsPublic(state, data.isPublic)
}

export default mutations
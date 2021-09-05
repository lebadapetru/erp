const defaultState = {
  id: null,
  title: '',
  description: '',
  isPublic: true,
}

const state = {
  defaultState: Object.freeze(defaultState),
  ...defaultState,
}

export default state

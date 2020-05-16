import getters from './getters'
import mutations from './mutations'
import actions from './actions'

const defaultState = {
  isLoading: false,
  list: [],
  detail: {},
  errors: []
}

const inBrowser = typeof window !== 'undefined'
// if in browser, use pre-fetched state injected by SSR
const state =
  inBrowser && window.__INITIAL_STATE__
    ? window.__INITIAL_STATE__.page
    : defaultState

export default {
  state,
  getters,
  mutations,
  actions
}

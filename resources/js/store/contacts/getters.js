import { CONTACTS_IS_LOADING, CONTACTS_LIST, CONTACTS_DETAIL, CONTACTS_ERRORS } from './types'

export default {
  [CONTACTS_IS_LOADING](state) {
    return state.isLoading
  },
  [CONTACTS_LIST](state) {
    return state.list
  },
  [CONTACTS_DETAIL](state) {
    return state.detail
  },
  [CONTACTS_ERRORS](state) {
    return state.errors
  }
}

import { CONTACTS_SET_IS_LOADING, CONTACTS_SET_LIST, CONTACTS_SET_ERRORS, CONTACTS_SET_DETAIL } from './types'

export default {
  [CONTACTS_SET_IS_LOADING](state, isLoading) {
    state.isLoading = isLoading
  },
  [CONTACTS_SET_LIST](state, contacts) {
    state.list = contacts
  },
  [CONTACTS_SET_DETAIL](state, contact) {
    state.detail = contact
  },
  [CONTACTS_SET_ERRORS](state, errors) {
    state.errors = errors
  }
}

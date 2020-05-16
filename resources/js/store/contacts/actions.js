import axios from 'axios'

import {
  CONTACTS_SET_IS_LOADING,
  CONTACTS_SET_LIST,
  CONTACTS_SET_DETAIL,
  CONTACTS_SET_ERRORS,
  CONTACTS_GET_LIST,
  CONTACTS_GET_DETAIL,
  CONTACTS_CREATE,
  CONTACTS_DELETE
} from './types'

export default {
  [CONTACTS_GET_LIST]({ dispatch, commit }) {
    commit(CONTACTS_SET_IS_LOADING, true)

    axios.get('http://localhost:8000/api/contacts')
      .then(response => {
        const contacts = response.data
        commit(CONTACTS_SET_LIST, contacts)
        commit(CONTACTS_SET_IS_LOADING, false)
      });

  },
  [CONTACTS_CREATE]({dispatch, commit}, contactFile) {
    commit(CONTACTS_SET_IS_LOADING, true)

    axios.post('http://localhost:8000/api/contacts', contactFile)
      .then(response => {
        location.href = '/contacts'
      })
      .catch(error => {
        commit(CONTACTS_SET_ERRORS, error.response.data.errors.contacts)
        commit(CONTACTS_SET_IS_LOADING, false)
      });
  },
  [CONTACTS_GET_DETAIL]({ dispatch, commit }, id) {
    commit(CONTACTS_SET_IS_LOADING, true)

    axios.get(`http://localhost:8000/api/contacts/${id}`)
      .then(response => {
        const contact = response.data
        commit(CONTACTS_SET_DETAIL, contact)
        commit(CONTACTS_SET_IS_LOADING, false)
      }).catch((error) => {
        commit(CONTACTS_SET_ERRORS, 'Error al importar archivo')
        commit(CONTACTS_SET_IS_LOADING, false)
      });
  },
  [CONTACTS_DELETE]({ dispatch, commit}, id) {
    commit(CONTACTS_SET_IS_LOADING, true)

    console.log('id', id);

    axios.delete(`http://localhost:8000/api/contacts/${id}`)
      .then(response => {
        const contacts = response.data
        commit(CONTACTS_SET_LIST, contacts)
        commit(CONTACTS_SET_IS_LOADING, false)
      });
  }
}

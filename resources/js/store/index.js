import Vuex from 'vuex'
import contacts from './contacts'

const createStore = () => {
  return new Vuex.Store({
    namespaced: true,
    modules: {
      contacts
    }
  })
}

export default createStore
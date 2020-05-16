<template>
  <div id="page_import">
    <h1>Import contacts</h1>
    <section>
      <v-container>
        <v-row>
          <v-col cols="12">Archivo:</v-col>
          <v-col cols="12" v-if="errors && errors.length > 0" class="errors">
            <p v-for="(error, index) in errors" :key="index">
              {{error}}
            </p>
          </v-col>
          <v-col cols="12">
            <v-file-input multiple label="File input" v-model="contactsFileSelected" ></v-file-input>
          </v-col>
          <v-col cols="12">
            <v-btn
              color="primary"
              type="button"
              class="btn-block z-depth-2"
              :disabled="!contactsFileSelected || isLoading"
              @click="onUpdateAccountProfilePicture"
            >{{ isLoading ? 'Cargando' : 'Importar' }}</v-btn>
          </v-col>
        </v-row>
      </v-container>
    </section>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

import { CONTACTS_ERRORS, CONTACTS_CREATE, CONTACTS_IS_LOADING } from '../store/contacts/types'

export default {
  data() {
    return {
      contactsFileSelected: null
    }
  },
  computed: {
    ...mapGetters({
      isLoading: CONTACTS_IS_LOADING,
      errors: CONTACTS_ERRORS
    })
  },
  methods: {
    ...mapActions({
      contactsCreate: CONTACTS_CREATE
    }),
    onUpdateAccountProfilePicture() {
      const contactsFile = new FormData()

      if (this.contactsFileSelected[0] && this.contactsFileSelected[0].name) {
        contactsFile.append(
          'contacts',
          this.contactsFileSelected[0],
          this.contactsFileSelected[0].name
        )
        this.contactsCreate(contactsFile)
      }
    }
  }
};
</script>

<style scoped>
.errors {
  color: red
}
</style>
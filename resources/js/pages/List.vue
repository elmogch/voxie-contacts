<template>
  <div id="page_list">
    <h1>Contacts list</h1>
    <section>
      <p class="is-loading" v-if="isLoading">
        Cargando...
      </p>
      <v-data-table v-else :headers="headers" :items="contacts" :items-per-page="10" class="elevation-1">
        <template v-slot:item.actions="{ item }">
          <v-btn x-small @click="contactShow(item.id)" color="primary">Ver detalle</v-btn>
          <v-btn x-small @click="contactsDelete(item.id)" color="error">Eliminar</v-btn>
        </template>
      </v-data-table>
    </section>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

import { CONTACTS_LIST, CONTACTS_GET_LIST, CONTACTS_DELETE, CONTACTS_IS_LOADING } from "../store/contacts/types";

export default {
  data() {
    return {
      headers: [
        { text: "Id", value: "id" },
        { text: "Team Id", value: "team_id" },
        { text: "First Name", value: "first_name" },
        { text: "Last Name", value: "last_name" },
        { text: "Email", value: "email" },
        { text: "Created at", value: "created_at" },
        { text: 'Actions', value: 'actions', sortable: false },
      ]
    };
  },
  computed: {
    ...mapGetters({
      isLoading: CONTACTS_IS_LOADING,
      contacts: CONTACTS_LIST
    })
  },
  methods: {
    ...mapActions({
      contactsGetList: CONTACTS_GET_LIST,
      contactsDelete: CONTACTS_DELETE
    }),
    contactShow(id) {
      this.$router.push(`/contacts/${id}`)
    }
  },
  mounted() {
    this.contactsGetList();
  }
};
</script>

<style scoped>
.is-loading {
  text-align: center;
  font-size: 1em;
}
</style>
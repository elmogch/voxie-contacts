<template>
  <div id="page_import">
    <h1>Contact detail: {{contact.first_name}}</h1>
    <section>
      <div v-for="(contactValue, contactKey) in contact" :key="contactKey">
        <div v-if="contactKey !== 'custom_attributes'" class="contact-row">
          <div class="contact-column contact-key">{{contactKey}}: &nbsp;&nbsp;</div>
          <div class="contact-column contact-value">{{contactValue}}</div>
        </div>
        <div v-else>
          <div v-for="(customAttribute, customAttributeIndex) in contactValue" :key="customAttributeIndex">
            <div v-for="(customAttributeValue, customAttributeKey) in customAttribute" :key="customAttributeKey" class="contact-row">
              <div v-if="customAttributeKey=='key' || customAttributeKey=='value'" class="contact-column contact-key">{{customAttributeKey}}: &nbsp;&nbsp;</div>
              <div v-if="customAttributeKey=='key' || customAttributeKey=='value'" class="contact-column contact-value">{{customAttributeValue}}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="back">
        <v-btn color="primary" to="/contacts">Regresar</v-btn>
      </div>
    </section>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

import { CONTACTS_DETAIL, CONTACTS_GET_DETAIL } from "../store/contacts/types";

export default {
  computed: {
    ...mapGetters({
      contact: CONTACTS_DETAIL
    })
  },
  methods: {
    ...mapActions({
      contactsGetDetail: CONTACTS_GET_DETAIL
    })
  },
  mounted() {
    const id = this.$route.params.id
    console.log('router id: ', id)
    this.contactsGetDetail(id);
  }
};
</script>

<style scoped>
.contact-row {
  width: 100%;
  display: flex;
}

.contact-column {
  width: 50%;
}

.contact-key {
  font-weight: bold;
}
.back {
  text-align: center;
  margin-top: 50px;
}
</style>
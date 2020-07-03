<template>
  <v-container >
    <v-row>
      <v-flex d-flex >
        <v-layout >
          <v-flex  v-for="item in companies" :key="item.id"  xs6>
            <v-card max-width="444" class="mx-auto">
              <v-list-item>
                <v-list-item-avatar color="grey"></v-list-item-avatar>
                <v-list-item-content>
                  <v-list-item-title class="headline">{{item.title}}</v-list-item-title>
                  <v-list-item-subtitle>{{item.subtitle}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-img :src="item.imagepath" height="220"></v-img>
              <v-card-text>{{item.link}}</v-card-text>
            </v-card>
          </v-flex>
        </v-layout>
      </v-flex>
    </v-row>
  </v-container>
</template>


<script>
export default {
  data() {
    return {
      companies: [],
      company: {}
    };
  },

  created() {
   
      let uri = process.env.MIX_APP_URL + ":" + process.env.MIX_APP_PORT + "/api/getcompany";
      this.axios.get(uri).then(res => {
        console.log(res);
        this.companies = res.data
      })
  }
};
</script>
<template>
  <v-container fluid="" m-0 pt-2 pr-0 pl-0 grid-list-md text-xs-center>
    <!-- <div class="responsive">
      <div class="gallery">
        <a target="_blank" href="img_5terre.jpg">
          <img src="img/sample1.jpg" alt="Cinque Terre" width="600" height="400" />
        </a>
        <div class="desc">Add a description of the image here</div>
      </div>
    </div> -->
   
        <v-layout row wrap >
          <v-flex  v-for="item in galleries" :key="item.id" xs3 >
            <v-card >
              <v-img :src="item.imagepath" height="190"></v-img>
              <v-card-text class=text-center>{{item.description}}</v-card-text>
            </v-card>
          </v-flex>
        </v-layout>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      galleries: [],
      gallery: {}
    };
  },

  created() {
      let uri = process.env.MIX_APP_URL + ":" + process.env.MIX_APP_PORT + "/api/getgallery";
      this.axios.get(uri).then(res => {
        console.log('galleries=', res);
        this.galleries = res.data
      })
  }
};
</script>
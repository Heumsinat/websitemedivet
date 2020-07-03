<template>
  <v-app> 
    <v-carousel height="100%">
      <v-carousel-item
        v-for="(item,i) in sliders"
        :key="i"
        :src="item.imagepath"
        reverse-transition="fade-transition"
        transition="fade-transition">          

        </v-carousel-item>
    </v-carousel>
  </v-app>
</template>

<script>
  export default {
    data () {
      // return {
      //   items: [
      //     {
      //       src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
      //     },
      //     {
      //       src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
      //     },
      //     {
      //       src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
      //     },
      //     {
      //       src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
      //     },
      //   ],
      // }
      return{
        sliders: [],
        slider: {}
      } 
    },

    created() {
            // let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/slider';
            // const config = {
            //     headers: { 
            //         Authorization: 'Bearer ' + localStorage.getItem('token'),
            //         Accept: 'application/json'
            //         }
            // };
            // this.axios.get(uri,config).then(res => {
            //     console.log(res);
            //     this.sliders = res.data
            // })
            let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/getslider';
            this.axios.get(uri).then(res => {
                console.log(res);
                this.sliders = res.data
            })
            
        }
  }
</script>
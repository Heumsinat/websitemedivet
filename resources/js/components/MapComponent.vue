<template>
  <v-container fluid="" m-0 pt-2 pr-0 pl-0>
        <!-- <div class="flex-center">OUR LOCATION</div> -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.898620588786!2d104.87040281463013!3d11.559124991793349!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951b9af262a87%3A0x13c388cf8021491d!2sMEDIVET%20GROUP!5e0!3m2!1skm!2skh!4v1593489537237!5m2!1skm!2skh" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"  ></iframe>
        <v-banner two-line color="#05dcf0">
          <v-avatar slot="icon" color="deep-purple accent-4" size="40">
            <v-icon icon="mdi-lock" color="white">mdi-dialpad</v-icon>
          </v-avatar>
          <div >YOU CAN CONTACT US BY : 078949799/medivet@online.com.kh</div>
        </v-banner>
  </v-container>
</template>

<script>
export default {
  // data: () => ({
  //   map: null
  // }),
  // mounted() {
  //   this.map = new window.google.maps.Map(this.$refs["map"], {
  //     center: { lat: -25.344, lng: 131.036 },
  //     zoom: 4
  //   });
  //   new window.google.maps.Marker({
  //     position: { lat: -25.344, lng: 131.036 },
  //     map: this.map
  //   });
  // }
};
</script>
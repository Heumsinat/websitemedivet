

require('./bootstrap');

window.Vue = require('vue');


import vuetify from './vuetify';
import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import router from './router'

Vue.use(VueAxios,axios);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('vuetify-component', require('./components/VuetifyComponest.vue').default);
Vue.component('vcarousel-component', require('./components/VcarouselComponent.vue').default);
Vue.component('subsidiary-component', require('./components/SubsidiaryComponent.vue').default);
Vue.component('footer-component', require('./components/FooterComponent.vue').default);
Vue.component('map-component', require('./components/MapComponent.vue').default);
Vue.component('portfolio-component', require('./components/PortfolioComponent.vue').default);

Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('app-component', require('./components/AppComponent.vue').default);
Vue.component('passport-clients', require('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-token', require('./components/passport/AuthorizedClients.vue').default);

Vue.component('news-component', require('./components/NewsComponent.vue').default);
Vue.component('login-component', require('./components/LoginComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    vuetify,
    router,
    el: '#app',
});

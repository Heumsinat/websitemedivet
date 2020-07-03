<template>
<v-app>
  <v-navigation-drawer app v-model="drawer">
    <v-list dense>
        <v-list-item three-line>
            <v-list-item-avatar>
              <v-icon x-large>mdi-account-convert</v-icon>
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title>{{user.name}}</v-list-item-title>
              <v-list-item-subtitle>{{user.email}}</v-list-item-subtitle>
              <v-list-item-action><v-btn small color="primary" @click.prevent="onLogout()">Logout</v-btn></v-list-item-action>
            </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>
        <v-list-item to="/" link>
            <v-list-item-action>
                <v-icon>mdi-home</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Dashboard</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
        <v-list-item to="/slider" link>
            <v-list-item-action>
                <v-icon>mdi-animation</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Slider</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
         <v-list-item to="/company" link>
            <v-list-item-action>
                <v-icon>mdi-animation</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Companies</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
        <v-list-item to="/gallery" link>
            <v-list-item-action>
                <v-icon>mdi-animation</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Gallery</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
        <v-list-item to="/clients" link>
            <v-list-item-action>
                <v-icon>mdi-web</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Clients</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
        <v-list-item to="/accesstoken" link>
            <v-list-item-action>
                <v-icon>mdi-message-text-lock</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Access Token</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
        <v-list-item to="/authorized" link>
            <v-list-item-action>
                <v-icon>mdi-account-lock</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Authorized</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

    </v-list>
  </v-navigation-drawer>

  <v-app-bar app color="#F0F0F0" >
    <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
    <v-toolbar-title>{{appname}}</v-toolbar-title>
  </v-app-bar>

  <v-content>
    <v-container fluid>
      <router-view></router-view>
    </v-container>
  </v-content>

  <v-footer app>
    <!-- -->
  </v-footer>
</v-app>
</template>

<script>
    export default {
    data () {
      return {
        drawer: null,
        appname: process.env.MIX_APP_NAME,
        user: {},
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    },
    created() {
      let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/user';
      const config = {
          headers: { 
              Authorization: 'Bearer ' + localStorage.getItem('token'),
              Accept: 'application/json'
            }
      };
      this.axios.get(uri,config).then(res => {
          console.log(res.data);
          this.user = res.data
      })
    },
    mounted() {
        console.log()
    },
    methods: {
      onLogout(){
        this.axios.post('/logout').catch(err => {
          console.log(err);
        });
        localStorage.removeItem('token');
        window.location.href = '/login';
      }
    }

    }
</script>
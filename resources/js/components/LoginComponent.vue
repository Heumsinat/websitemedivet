<template>
    <v-card light>
        <v-row justify="space-around">
            <v-col cols="12" sm="6" md="4">
                <v-avatar color="indigo" size="200">
                    <v-icon size="176">mdi-account-circle</v-icon>
                </v-avatar>
            </v-col>
            <v-col cols="12" sm="6" md="8">
                <v-form @submit.prevent="onLogin()">
                    <v-text-field  v-model="email" :error-messages="emailErrors" label="E-mail" required
                    @input="$v.email.$touch()"
                    @blur="$v.email.$touch()"
                    ></v-text-field>
                    <v-text-field type="password"  v-model="password" :error-messages="passErrors" label="Password" required
                    @input="$v.email.$touch()"
                    @blur="$v.email.$touch()"
                    ></v-text-field>
                    <v-btn type="submit" class="mr-4">submit</v-btn>
                </v-form>
            </v-col>         
        </v-row>
    </v-card>
</template>
<script>
  import { validationMixin } from 'vuelidate'
  import { required, maxLength, email } from 'vuelidate/lib/validators'

  export default {
    mixins: [validationMixin],

    validations: {
      password: { required, maxLength: maxLength(6) },
      email: { required, email },
    },

    data: () => ({
      email: '',
      password: ''
    }),

    computed: {
      emailErrors () {
        const errors = []
        if (!this.$v.email.$dirty) return errors
        !this.$v.email.email && errors.push('Must be valid e-mail')
        !this.$v.email.required && errors.push('E-mail is required')
        return errors
      },
      passErrors(){
        const errors = []
        if (!this.$v.email.$dirty) return errors
        !this.$v.email.required && errors.push('Password is required')
        return errors;
      }
    },

    methods: {
      onLogin () {
        if (this.$v.$invalid) {
            let userlg = {
                'email': this.email,
                'password': this.password,
                'remember_me': false
            };
            const config = {
                headers: { 
                      Accept: 'application/json'
                    }
            };
            let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/auth/login';
            this.axios.post(uri,userlg,config).then(res => {
                if(res.status != 401){
                    console.log(res.data.access_token);
                    localStorage.setItem('token',res.data.access_token);
                    window.location.href = '/home';
                }
                console.log(res.data);
            })
        }
        else{
            console.log('Invalid')
        }
      }
    },
  }
</script>
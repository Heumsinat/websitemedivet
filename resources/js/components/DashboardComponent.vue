<template>
    <v-container fluid>
        <v-row>
            <v-card @click="onClickSlider()" class="mx-auto" max-width="144" color="#F0F0F0" shaped outlined>
                <v-list-item three-line>
                <v-list-item-content>
                    <v-list-item-title class="headline mb-1">
                        <v-icon>mdi-home</v-icon>
                    </v-list-item-title>
                    <v-list-item-subtitle>
                        <router-link to="/slider">Image Slider</router-link>
                    </v-list-item-subtitle>
                </v-list-item-content>
                </v-list-item>
            </v-card>
            <v-card class="mx-auto" max-width="144" color="#F0F0F0" shaped outlined>
                <v-list-item three-line>
                <v-list-item-content>
                    <v-list-item-title class="headline mb-1">
                        <v-icon>mdi-animation</v-icon>
                    </v-list-item-title>
                    <v-list-item-subtitle>Subsidiary</v-list-item-subtitle>
                </v-list-item-content>
                </v-list-item>
            </v-card>
            <v-card class="mx-auto" max-width="144" color="#F0F0F0" shaped outlined>
                <v-list-item three-line>
                <v-list-item-content>
                    <v-list-item-title class="headline mb-1">
                        <v-icon>mdi-phone</v-icon>
                    </v-list-item-title>
                    <v-list-item-subtitle>Contact Us</v-list-item-subtitle>
                </v-list-item-content>
                </v-list-item>
            </v-card>
            <v-card class="mx-auto" max-width="144" color="#F0F0F0" shaped outlined>
                <v-list-item three-line>
                <v-list-item-content>
                    <v-list-item-title class="headline mb-1">
                        <v-icon>mdi-book</v-icon>
                    </v-list-item-title>
                    <v-list-item-subtitle>Portfolio</v-list-item-subtitle>
                </v-list-item-content>
                </v-list-item>
            </v-card>
        </v-row>        
    </v-container>
</template>

<script>
    export default {
        methods: {
            onClickSlider: function() {
                console.log('click')
            }
        }
    }
</script>
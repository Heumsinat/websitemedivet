<template>
    <v-container>
        <v-row>
            <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <template v-slot:activator="{ on, attrs }">
                <!-- <v-icon color="pink" dark v-bind="attrs" v-on="on" >mdi-playlist-plus</v-icon> -->
                <v-icon color="pink" v-bind="attrs" v-on="on" dark @click="onAdd()">mdi-playlist-plus</v-icon>
                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
            </template>
            
            <v-form v-model="valid" @submit.prevent="onSave()">
                <v-card>
                    <v-toolbar dark color="primary">
                    <v-btn icon dark @click="dialog = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Companies</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn type="submit" dark text >Save</v-btn>
                    </v-toolbar-items>
                    </v-toolbar>
                    

                        <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="company.title"  label="Title" hint="Title"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="company.subtitle"  label="Subtitle" hint="Subtitle"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-file-input v-on:change="processFile($event)" label="Image" required></v-file-input>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="company.link"  label="Link" hint="Link"></v-text-field>
                            </v-col>
                        </v-row>
                        </v-container>

                </v-card>
            </v-form>
            </v-dialog>
        </v-row>

        <v-data-table :headers="headers" :items="companies" :search="search" :items-per-page="5" class="elevation-1">
            <template v-slot:item="row">
                <tr>
                    <td>{{row.item.id}}</td>
                    <td>{{row.item.title}}</td>
                    <td>{{row.item.subtitle}}</td>
                    <td>{{row.item.imagepath}}</td>
                    <td>{{row.item.link}}</td>
                    <td>
                        <v-icon color="pink" dark @click="onEdit(row.item)">mdi-pencil</v-icon>
                    </td>
                    <td>
                        <v-icon color="pink" dark @click="onDelete(row.item)">mdi-delete-forever</v-icon>
                    </td>
                </tr>
            </template>
        </v-data-table>
    </v-container>
</template>
<script>
    export default {
        data() {
            return {
                dialog: false,
                notifications: false,
                sound: true,
                widgets: false,
                valid: false,
                search: '',
                headers: [
                { text: 'ID', value: 'id',visibled: true },
                { text: 'Title', value: 'title' },
                { text: 'Subtitle', value: 'subtitle' },
                { text: 'Image', value: 'imagepath' },
                { text: 'Link', value: 'link' }
                ],
                companies: [],
                company:{}
            }
        },
        created() {
            let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/company';
            const config = {
                headers: { 
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                    Accept: 'application/json'
                    }
            };
            this.axios.get(uri,config).then(res => {
                console.log(res);
                this.companies = res.data
            })
        },
        methods: {
            processFile(event){
                console.log('test get image',event);
                this.company.imagepath = event;

            },
            onAdd(){
                this.dialog = true;
                this.company = {};
            },
            onEdit(item){
                console.log('click on' + item.id)
                this.dialog = true;
                this.company = item;
            },
            onDelete(item){
                let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/company/' + item.id;
                this.axios.delete(uri).then(res => {
                    this.companies.splice(this.companies.indexOf(item.id),1);
                })
            },
            onSave(){
                const config = {
                    headers: { 
                        Authorization: 'Bearer ' + localStorage.getItem('token'),
                        Accept: 'application/json',
                        'Content-Type' : 'multipart/form-data'
                        }
                };
                console.log(this.company.image);
                let fd = new FormData();
                fd.append('title',this.company.title);
                fd.append('subtitle',this.company.subtitle);
                fd.append('imagepath',this.company.imagepath);
                fd.append('link',this.company.link);
                console.log('data',fd);
                if(this.company.id != null){
                    let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/company/' + this.company.id;
                    this.axios.put(uri,this.company).then(res => {
                        let index = this.company.indexOf(this.company.id);
                        this.company[index] = res.data
                    })
                }
                else{
                    let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/company';
                    this.axios.post(uri,fd,config).then(res => {
                        console.log(res.data);
                        this.companies.push(res.data)
                    })
                }
                this.dialog = false;
            }
        }
    }
</script>
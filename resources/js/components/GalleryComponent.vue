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
                    <v-toolbar-title>Gallery</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn type="submit" dark text >Save</v-btn>
                    </v-toolbar-items>
                    </v-toolbar>
                    

                        <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="gallery.description"  label="Description" hint="Description"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-file-input v-on:change="processFile($event)" label="Image" required></v-file-input>
                            </v-col>
                        </v-row>
                        </v-container>

                </v-card>
            </v-form>
            </v-dialog>
        </v-row>

        <v-data-table :headers="headers" :items="galleries" :search="search" :items-per-page="5" class="elevation-1">
            <template v-slot:item="row">
                <tr>
                    <td>{{row.item.id}}</td>
                    <td>{{row.item.imagepath}}</td>
                    <td>{{row.item.description}}</td>
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
                { text: 'Image Path', value: 'imagepath' },
                { text: 'Description', value: 'description' }
                ],
                galleries: [],
                gallery:{}
            }
        },
        created() {
            let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/gallery';
            const config = {
                headers: { 
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                    Accept: 'application/json'
                    }
            };
            this.axios.get(uri,config).then(res => {
                console.log(res);
                this.galleries = res.data
            })
        },
        methods: {
           processFile(event){
                console.log(event);
                this.gallery.imagepath = event;
            },
            onAdd(){
                this.dialog = true;
                this.gallery = {};
            },
            onEdit(item){
                console.log('click on' + item.id)
                this.dialog = true;
                this.gallery = item;
            },
            onDelete(item){
                let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/gallery/' + item.id;
                this.axios.delete(uri).then(res => {
                    this.galleries.splice(this.galleries.indexOf(item.id),1);
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
                let fd = new FormData();
                fd.append('description',this.gallery.description);
                fd.append('imagepath',this.gallery.imagepath);
                if(this.gallery.id != null){
                    let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/gallery/' + this.gallery.id;
                    this.axios.put(uri,this.gallery).then(res => {
                        let index = this.galleries.indexOf(this.gallery.id);
                        this.galleries[index] = res.data
                    })
                }
                else{
                    let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/gallery';
                    this.axios.post(uri,fd,config).then(res => {
                        console.log(res);
                        this.galleries.push(res.data)
                    })
                }
                this.dialog = false;
            }
        }
    }
</script>
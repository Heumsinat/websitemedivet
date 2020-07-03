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
                    <v-toolbar-title>Images Slider</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn type="submit" dark text >Save</v-btn>
                    </v-toolbar-items>
                    </v-toolbar>
                    

                        <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="slider.description"  label="Description" hint="Description"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-file-input v-on:change="processFile($event)" label="Image" required></v-file-input>
                                <!-- <v-file-input v-model="slider.imagepath" label="Select Image" required></v-file-input> -->
                            </v-col>
                        </v-row>
                        </v-container>

                </v-card>
            </v-form>
            </v-dialog>
        </v-row>

        <v-data-table :headers="headers" :items="sliders" :search="search" :items-per-page="5" class="elevation-1">
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
                sliders: [],
                slider:{}
            }
        },
        created() {
            // let uri = 'http://127.0.0.1:8000/api/slider';
            let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/slider';
            const config = {
                headers: { 
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                    Accept: 'application/json'
                    }
            };
            this.axios.get(uri,config).then(res => {
                console.log(res);
                this.sliders = res.data
            })
        },
        methods: {
            processFile(event){
                console.log(event);
                this.slider.imagepath = event;
            },
            onAdd(){
                this.dialog = true;
                this.slider = {};
            },
            onEdit(item){
                console.log('click on' + item.id)
                this.dialog = true;
                this.slider = item;
            },
            onDelete(item){
                let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/slider/' + item.id;
                this.axios.delete(uri).then(res => {
                    this.sliders.splice(this.sliders.indexOf(item.id),1);
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
                fd.append('description',this.slider.description);
                fd.append('imagepath',this.slider.imagepath);
                if(this.slider.id != null){
                    let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/slider/' + this.slider.id;
                    this.axios.put(uri,this.slider).then(res => {
                        let index = this.sliders.indexOf(this.slider.id);
                        this.sliders[index] = res.data
                    })
                }
                else{
                    let uri = process.env.MIX_APP_URL + ':' + process.env.MIX_APP_PORT + '/api/slider';
                    this.axios.post(uri,fd,config).then(res => {
                        console.log(res);
                        this.sliders.push(res.data)
                    })
                }
                this.dialog = false;
            }
        }
    }
</script>
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import SliderComponent from './components/SliderComponent'
import CompaniesComponent from './components/CompaniesComponent'
import GalleryComponent from './components/GalleryComponent'
import DashboardComponent from './components/DashboardComponent'
import Clients from './components/passport/Clients'
import PersonalAccessTokens from './components/passport/PersonalAccessTokens'
import AuthorizedClients from './components/passport/AuthorizedClients'
import SubsidiaryComponent from './components/SubsidiaryComponent'

const routes = [
    {path: '/', component: DashboardComponent},
    {path: '/slider', component: SliderComponent},
    {path: '/company', component: CompaniesComponent},
    {path: '/gallery', component: GalleryComponent},
    {path: '/clients', component: Clients},
    {path: '/authorized', component: AuthorizedClients},
    {path: '/accesstoken', component: PersonalAccessTokens},
    {path: '/subsidary',component:SubsidiaryComponent}
]

export default new VueRouter({
    routes
})
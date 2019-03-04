import VueRouter from 'vue-router';
import { Form, HasError, AlertError } from "vform";
import Swal from "sweetalert2";


// CommonJS

require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueRouter);
window.Swal=Swal;


const routes = [
  { path: "/dashboard", component: require("./components/Dashboard.vue") },
  { path: "/mission", component: require("./components/Mission.vue") },
  {
    path: "/mission/detail/:id",
    component: require("./components/MissionDetail.vue")
  },
  { path: "/mission/add", component: require("./components/MissionAdd.vue") },
  { path: "/today", component: require("./components/Today.vue") },
  { path: "/step", component: require("./components/Step.vue") },
  { path: "/note", component: require("./components/Note.vue") }
];

const router = new VueRouter({
    mode:'history',
    routes // short for `routes: routes`
})
window.Form=Form;

Vue.component("menu-component", require("./components/Menu.vue"));
Vue.component('mission-component', require('./components/Mission.vue'));
Vue.component('mission-add-component', require('./components/MissionAdd.vue'));
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

const app = new Vue({
    router,
    el: '#app',
    
});

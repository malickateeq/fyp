
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');

import { Form, HasError, AlertError } from 'vform';
import moment from 'moment';

// Google Maps Vue2 package
import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'

// Vue.use(VueGoogleMaps, {load: false});
 
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyAVELSX6ErxUO5vgrxO_z9SHZyf_RvdP3w',
    libraries: 'places, directions', // This is required if you use the Autocomplete plugin

    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    //// If you want to set the version, you can do so:
    // v: '3.26',
  },
 
  //// If you intend to programmatically custom event listener code
  //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
  //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
  //// you might need to turn this on.
  // autobindAllEvents: false,
 
  //// If you want to manually install components, e.g.
  //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
  //// Vue.component('GmapMarker', GmapMarker)
  //// then disable the following:
  // installComponents: true,
})
// Google Maps Vue2 package


// ES6 Modules or TypeScript
import Swal from 'sweetalert2'

window.Swal = Swal; //Globally available

//Event handling
window.Fire = new Vue();    //window.var make var globally available.

//Toast
const toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.toast = toast;

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


Vue.prototype.$baseURL = '';
// Vue.prototype.$baseURL = '/2019/picknride';

const thread = Vue.component('thread', require('./components/chat/thread.vue').default);
const chat = Vue.component('chat', require('./components/chat/chat.vue').default);

import VueRouter from 'vue-router'
Vue.use(VueRouter)

const routes = [
    //Admin paths
    { path: '/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/adminProfile', component: require('./components/admin/Profile.vue').default },
    { path: '/users', component: require('./components/admin/Users.vue').default },

    //Rider Paths
    { path: '/riderProfile', component: require('./components/rider/Profile.vue').default },
    { path: '/myRides', component: require('./components/rider/myRides.vue').default },
    { path: '/showPreview/:prevId', props: true, name: 'showPreview', component: require('./components/rider/showPreview.vue').default },

    //Driver Paths
    { path: '/driverProfile', component: require('./components/driver/Profile.vue').default },
    { path: '/relevantRiders', component: require('./components/driver/relevantRiders.vue').default },
    { path: '/riderPreview/:prevId', props: true, name: 'riderPreview', component: require('./components/driver/riderPreview.vue').default },

    //Public Almost

    //Chat Paths
    { path: '/chat', component: chat, name: 'chat', props: true},


  ]
  
Vue.prototype.$myId = 'null';
Vue.prototype.$friendId = 'null';
const router = new VueRouter({
  //Will register routes for all components
    mode: 'history', //Show simple url not complete path
    routes // short for `routes: routes` 
  })

Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('regDate', function(date){
    return moment(date).format('Do MMMM YYYY');
});

Vue.filter('timeAgo', function(date){
  return moment(date).fromNow();
});

//Register as a global component: Laravel-Vue-Pagination
Vue.component('pagination', require('laravel-vue-pagination'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('public-rides', require('./components/public/publicRides.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  router,
});


// Search Rides Components

const search_app = new Vue({
  el: '#search-app',
  });


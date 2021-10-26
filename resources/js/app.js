
require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';
import Vuetify from 'vuetify'
import VueSwal from 'vue-swal'
Vue.use(Vuetify);
Vue.use(VueSwal)


Vue.component('encuesta-component', require('./components/EncuestaComponent.vue').default);
Vue.component('encuestaok-component', require('./components/EncuestaOkComponent.vue').default);
Vue.component('correo-component', require('./components/CorreoComponent.vue').default);
Vue.component('respuesta-component', require('./components/RespuestaComponent.vue').default);


const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
});

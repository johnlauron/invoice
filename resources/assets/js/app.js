
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('editor', require('./components/EditorComponent.vue'));
// Vue.component('input-generator', require('./components/InputGenerator.vue'));
// Vue.component('input-component', require('./components/InputComponent.vue'));
// Vue.component('input-fixed-component', require('./components/vue-draggable-resizable.vue'));
// const app = new Vue({
//     el: '#app'
// });
Vue.component('generate-box', require('./components/generatebox.vue'));
var app = new Vue({
	el: '#app'
})


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Our Vuejs event handler which we will be using for flash messaging
 * @type {Vue}
 */
window.events = new Vue();

/**
 * Our Flash function which will be used to add new flash events to our event handler
 *
 * @param  String message Our alert message
 * @param  String type    The type of alert we want to show
 */
window.flash = function(message, type) {
    window.events.$emit('flash', message, type);
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('issues', require('./components/Issues.vue'));
Vue.component('lane', require('./components/Lane.vue'));
Vue.component('paginator', require('./components/Paginator'));
Vue.component('pagination', require('./components/Pagination'));
Vue.component('flash', require('vue-flash'));

Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));

Vue.mixin({
    methods: {
        route: route,
    }
});

import auth from './mixins/auth';
Vue.mixin(auth);

const app = new Vue({
    el: '#app'
}).$mount();

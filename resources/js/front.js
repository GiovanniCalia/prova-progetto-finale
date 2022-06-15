/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Axios = require('axios');

const { default: Axios } = require('axios');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import VueRouter from 'vue-router';
import App from './views/App.vue';

import HomePage from './pages/HomePage.vue';
import IndexPage from './pages/IndexPage.vue';
import ShowPage from './pages/ShowPage.vue';
import ContactPage from './pages/ContactPage.vue';
import AboutUs from './pages/AboutUs.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage,
        },
        {
            path: '/blog',
            name: 'IndexPage',
            component: IndexPage,
        },
        {
            path: '/blog/:slug',
            name: 'ShowPage',
            component: ShowPage,
            props: true,
        },
        {   path: '/contact',
            name: 'ContactPage',
            component: ContactPage,
        },
        {   path: '/about',
            name: 'AboutUs',
            component: AboutUs,
        },
    ],
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router,
});

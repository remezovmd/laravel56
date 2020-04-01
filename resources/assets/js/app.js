
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import articlesIndex from './components/ArticlesIndex.vue';
import articlesCreate from './components/ArticlesCreate.vue';
import articlesEdit from './components/ArticlesEdit.vue';
import articlesShow from './components/ArticlesShow.vue';

const routes = [
    {
        path: '/',
        component: articlesIndex,
        name: 'indexArticle'
    },
    {path: '/articlesCreate', component: articlesCreate, name: 'createArticle'},
    {path: '/articlesEdit/:id', component: articlesEdit, name: 'editArticle'},
    {path: '/articlesShow/:id', component: articlesShow, name: 'showArticle'},
]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')


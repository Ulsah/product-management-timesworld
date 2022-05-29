import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
window.Vue = require('vue').default;

// Admin Routes
import ViewProducts from './components/Admin/ViewProducts.vue';
import AddProduct from './components/Admin/AddProduct.vue';
import ViewProduct from './components/Admin/ViewProduct.vue';

//Vue.component('/admin/manage-users', require('./components/Admin/ManageUsers.vue').default);

import Home from './components/Home.vue';
import Denied from './components/Denied.vue';

Vue.component('home',require('./components/Home.vue').default);
Vue.component('denied',require('./components/Denied.vue').default);

const routes = [
	{
  	path: '/admin/view-products',
    meta:{ title: 'View Products'},
    component: ViewProducts,
    name: 'ViewProducts'
  },
  
  {
  	path: '/admin/add-product',
    meta:{ title: 'Add Product'},
    component: AddProduct,
    name: 'AddProduct'
  },
  
  {
  	path: '/admin/view-products',
    meta:{ title: 'View Products'},
    component: ViewProducts,
    name: 'ViewProducts'
  },
  
  {
  	path: '/admin/view-product/:id',
    meta:{ title: 'View Product'},
    component: ViewProduct,
    name: 'ViewProduct'
  },
  
  {
  	path: '/home',
    meta:{ title: 'Home'},
    component: Home,
    name: 'Home'
  },
  
  {
  	path: '*',
    meta:{ title: 'Denied'},
    component: Denied,
    name: 'Denied'
  }
];

const router = new VueRouter({
   mode: 'history',
   routes, // short for `routes: routes`
   linkActiveClass: 'active'
});

export default router;

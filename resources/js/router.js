import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
window.Vue = require('vue').default;

// Admin Routes
import ViewCountry from './components/Admin/ViewCountry.vue';
import AddCountry from './components/Admin/AddCountry.vue';

//Vue.component('/admin/manage-users', require('./components/Admin/ManageUsers.vue').default);

import Profile from './components/Profile.vue';
import Denied from './components/Denied.vue';

Vue.component('profile',require('./components/Profile.vue').default);
Vue.component('denied',require('./components/Denied.vue').default);

const routes = [
	{
  	path: '/admin/view-country',
    meta:{ title: 'View Country'},
    component: ViewCountry,
    name: 'ViewCountry'
  },
  
  {
  	path: '/admin/add-country',
    meta:{ title: 'Add Country'},
    component: AddCountry,
    name: 'AddCountry'
  },
  
  {
  	path: '/denied',
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

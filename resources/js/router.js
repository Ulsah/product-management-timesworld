import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
window.Vue = require('vue').default;

// Admin Routes
import ManageUsers from './components/Admin/ManageUsers.vue';
import ManageAdminAppointments from './components/Admin/ManageAdminAppointments.vue';

// Doctor Routes
import ManageDoctorAppointments from './components/Doctor/ManageDoctorAppointments.vue';
import ManageReports from './components/Doctor/ManageReports.vue';

// User Routes
import ManageUserAppointments from './components/User/ManageUserAppointments.vue';

//Vue.component('/admin/manage-users', require('./components/Admin/ManageUsers.vue').default);

import Profile from './components/Profile.vue';
import Denied from './components/Denied.vue';

Vue.component('profile',require('./components/Profile.vue').default);
Vue.component('denied',require('./components/Denied.vue').default);

const routes = [
	{
  	path: '/admin/manage-users',
    meta:{ title: 'Manage Users'},
    component: ManageUsers,
    name: 'ManageUsers'
  },
  
  {
  	path: '/admin/manage-appointments',
    meta:{ title: 'Manage Appointments'},
    component: ManageAdminAppointments,
    name: 'ManageAdminAppointments'
  },
  
  {
  	path: '/doctor/manage-appointments',
    meta:{ title: 'Manage Appointments'},
    component: ManageDoctorAppointments,
    name: 'ManageDoctorAppointments'
  },
  
  {
  	path: '/doctor/reports/:id',
    meta:{ title: 'Manage Reports'},
    component: ManageReports,
    name: 'ManageReports'
  },
  
  {
  	path: '/user/manage-appointments',
    meta:{ title: 'Manage Appointments'},
    component: ManageUserAppointments,
    name: 'ManageUserAppointments'
  },
  
  {
  	path: '/profile',
    meta:{ title: 'User Profile'},
    component: Profile,
    name: 'UserProfile'
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

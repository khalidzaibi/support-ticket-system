import { createRouter, createWebHistory } from 'vue-router'
import TicketForm from '../views/TicketForm.vue'
import Login from '../views/Admin/Login.vue'
import TicketList from '../views/Admin/TicketList.vue'
import TicketView from '../views/Admin/TicketView.vue'

const routes = [
  { path: '/', component: TicketForm },
  { path: '/admin/login', name: 'Login', component: Login },
  { path: '/admin/tickets', component: TicketList,  meta: { requiresAuth: true }, },
  { path: '/admin/tickets/:type/:id', component: TicketView, props: true, meta: { requiresAuth: true }, },
]


const router = createRouter({
  history: createWebHistory(),
  routes
})


router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');

  if (to.meta.requiresAuth && !token) {    
    next({ name: 'Login' });
  } else {
    next();
  }
});

export default router

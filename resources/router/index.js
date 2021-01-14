import { createRouter, createWebHistory } from "vue-router";

const TheDashboard = () => import('../views/dashboard/TheDashboard')

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      component: TheDashboard
    }
  ]
})
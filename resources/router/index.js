import { createRouter, createWebHistory } from "vue-router";

const TheDashboard = () => import('../views/dashboard/TheDashboard')
const TheCategories = () => import('../views/categories/TheCategories')
const TheProducts = () => import('../views/products/TheProducts')
const TheServices = () => import('../views/services/TheServices')
const NotFound = () => import('../views/dashboard/TheDashboard')

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'Dashboard',
      component: TheDashboard,
      category: ['TheLeftNav']
    },
    {
      path: '/categories',
      name: 'Categories',
      component: TheCategories,
      children: [
        {
          path: '/service/:id/edit',
          name: 'Edit product',
          component: TheCategories
        },
      ],
      category: ['TheLeftNav']
    },
    {
      path: '/products',
      name: 'Products',
      component: TheProducts,
      children: [
        {
          path: '/product/:id/edit',
          name: 'Edit product',
          component: TheProducts
        },
      ],
      category: ['TheLeftNav']
    },
    {
      path: '/services',
      name: 'Services',
      component: TheServices,
      children: [
        {
          path: '/service/:id/edit',
          name: 'Edit product',
          component: TheServices
        },
      ],
      category: ['TheLeftNav']
    },
    {
      path: "/:catchAll(.*)",
      component: NotFound,
      category: ['system']
    },
  ]
})
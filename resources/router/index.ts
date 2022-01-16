import { createRouter, createWebHistory } from "vue-router";

//TODO replace children structure with plain because the parents are rendered even when not visited
const routes = [
  {
    path: '/login',
    name: 'login',
    component: () => import('resources/views/login/TheLogin.vue'),
    meta: {
      title: 'Login',
      isSystem: true,
    }
  },
  {
    path: '/',
    name: 'home',
    redirect: "/dashboard",
    component: () => import('resources/themes/base/Layout.vue'),
    children: [
      {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import('resources/views/dashboard/TheDashboard.vue'),
        meta: {
          title: 'Dashboard',
          svgIcon: "/build/media/icons/duotone/Design/PenAndRuller.svg",
        }
      },
      {
        path: '/ecommerce',
        name: 'ecommerce',
        component: () => import('resources/views/ecommerce/TheECommerce.vue'),
        children: [
          {
            path: '/products',
            name: 'products',
            component: () => import('resources/views/products/TheProducts.vue'),
            children: [
              {
                path: '/products/new',
                name: 'addProduct',
                component: () => import('resources/views/products/components/forms/product/VProductForm.vue'),
                meta: {
                  title: 'Add product',
                }
              },
              {
                path: '/products/:id/edit',
                name: 'editProduct',
                component: () => import('resources/views/products/components/forms/product/VProductForm.vue'),
                props: true,
                meta: {
                  title: 'Edit product',
                }
              },
            ],
            meta: {
              title: 'Products',
              isListing: true
            }
          },
          {
            path: '/categories',
            name: 'categories',
            component: () => import('resources/views/categories/TheCategories.vue'),
            children: [],
            meta: {
              title: 'Categories',
            }
          },
        ],
        meta: {
          title: 'E-Commerce',
          svgIcon: '/build/media/icons/duotone/Shopping/Cart2.svg'
        }
      },
    ],
    meta: {
      isSystem: true,
    }
  },
  {
    //    path: "/:pathMatch(.*)*",
    path: "/:catchAll(.*)",
    name: "404",
    component: () => import("resources/themes/base/error/Error404.vue"),
    meta: {
      isSystem: true,
    }
  },
  {
    path: "/500",
    name: "500",
    component: () => import("resources/themes/base/error/Error500.vue"),
    meta: {
      isSystem: true,
    }
  },
]

/*the routes are dependent of services, and services should be requested through api to check validity*/
const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const publicPages = ['/login', '/register'];
  const authRequired = !publicPages.includes(to.path);
  const loggedIn = localStorage.getItem('user');

  // trying to access a restricted page + not logged in
  // redirect to login page
  if (authRequired && !loggedIn) {
    //next('/login');
    next();
  } else {
    next();
  }
})

export default router
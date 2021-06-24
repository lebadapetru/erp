import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: '/login',
    name: 'login',
    component: () => import('resources/views/login/TheLogin'),
    meta: {
      title: 'Login',
      isSystem: true,
    }
  },
  {
    path: '/',
    name: 'home',
    redirect: "/dashboard",
    component: () => import('resources/themes/base/Layout'),
    children: [
      {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import('resources/views/dashboard/TheDashboard'),
        meta: {
          title: 'Dashboard',
          svgIcon: "build/media/icons/duotone/Design/PenAndRuller.svg",
        }
      },
      {
        path: '/ecommerce',
        name: 'ecommerce',
        component: () => import('resources/views/ecommerce/TheECommerce'),
        children: [
          {
            path: '/products',
            name: 'products',
            component: () => import('resources/views/products/TheProducts'),
            children: [
              {
                path: '/products/new',
                name: 'add product',
                component: () => import('resources/views/products/components/forms/product/VProductForm'),
                meta: {
                  title: 'Add product',
                }
              },
              {
                path: '/products/:id/edit',
                name: 'edit product',
                component: () => import('resources/views/products/components/forms/product/VProductForm'),
                props: true,
                meta: {
                  title: 'Edit product',
                }
              },
            ],
            meta: {
              title: 'Products',
              svgIcon: `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
         <polygon points="0 0 24 0 24 24 0 24"/>
         <path d="M3.52270623,14.028695 C2.82576459,13.3275941 2.82576459,12.19529 3.52270623,11.4941891 L11.6127629,3.54050571 C11.9489429,3.20999263 12.401513,3.0247814 12.8729533,3.0247814 L19.3274172,3.0247814 C20.3201611,3.0247814 21.124939,3.82955935 21.124939,4.82230326 L21.124939,11.2583059 C21.124939,11.7406659 20.9310733,12.2027862 20.5869271,12.5407722 L12.5103155,20.4728108 C12.1731575,20.8103442 11.7156477,21 11.2385688,21 C10.7614899,21 10.3039801,20.8103442 9.9668221,20.4728108 L3.52270623,14.028695 Z M16.9307214,9.01652093 C17.9234653,9.01652093 18.7282432,8.21174298 18.7282432,7.21899907 C18.7282432,6.22625516 17.9234653,5.42147721 16.9307214,5.42147721 C15.9379775,5.42147721 15.1331995,6.22625516 15.1331995,7.21899907 C15.1331995,8.21174298 15.9379775,9.01652093 16.9307214,9.01652093 Z" fill="#000000" fill-rule="nonzero" opacity="1"/>
      </g>
   </svg>`
            }
          },
          {
            path: '/categories',
            name: 'categories',
            component: () => import('../views/categories/TheCategories'),
            children: [
              {
                path: '/categories/:id/edit',
                name: 'edit category',
                component: () => import('../views/categories/TheCategories'),
                meta: {
                  title: 'Edit category',
                }
              },
            ],
            meta: {
              title: 'Categories',
              svgIcon: `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
         <polygon points="0 0 24 0 24 24 0 24"/>
         <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"/>
         <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"/>
      </g>
   </svg>`
            }
          },
        ],
        meta: {
          title: 'E-Commerce',
          svgIcon: 'build/media/icons/duotone/Shopping/Cart2.svg'
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
    component: () => import("resources/themes/base/error/Error404"),
    meta: {
      isSystem: true,
    }
  },
  {
    path: "/500",
    name: "500",
    component: () => import("resources/themes/base/error/Error500"),
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
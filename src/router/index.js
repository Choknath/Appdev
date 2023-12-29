import { createRouter, createWebHistory } from 'vue-router'
import SignPage from '../views/SignPage.vue'

const routes = [
  
  {
    path: '/',
    component: SignPage
  },
   {
     path: '/Registration',
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
     component: () => import(/* webpackChunkName: "about" */ '../views/RegistrationPage.vue'),
   
   },
  {
    path: '/Home',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/HomePage.vue'),
    meta:{requiredAuth: true}
  },
  {
    path: '/Event',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/HomeView.vue'),
    meta:{requiredAuth: true}
  },
  {
    path: '/Market',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/MarketPage.vue'),
    meta:{requiredAuth: true}
  },
  {
  path: '/Profile',
  // route level code-splitting
  // this generates a separate chunk (about.[hash].js) for this route
  // which is lazy-loaded when the route is visited.
  component: () => import(/* webpackChunkName: "about" */ '../views/ProfilePage.vue'),
  meta:{requiredAuth: true}
  },
  {
    path: '/EditProf',
    component: () => import(/* webpackChunkName: "about" */ '../views/EditProfile.vue'),
    meta:{requiredAuth: true}
  },
  {
    path: '/ProfEvent',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Eventprofile.vue'),
    meta:{requiredAuth: true}
  },
  
  {
    path: '/Events',
    component: () => import(/* webpackChunkName: "about" */ '../views/Profevent.vue'),
    meta:{requiredAuth: true}
  },
  
  {
    path: '/Messages',
    component: () => import(/* webpackChunkName: "about" */ '../views/Comm.vue'),
    meta:{requiredAuth: true}
  },

  {
    path: '/Products',
    component: () => import(/* webpackChunkName: "about" */ '../views/Formmark.vue'),
    meta:{requiredAuth: true}
  },

  {
    path: '/Items',
    component: () => import(/* webpackChunkName: "about" */ '../views/Profmarket.vue'),
    meta:{requiredAuth: true}
  },

  {
    path: '/CreatePost',
    component: () => import(/* webpackChunkName: "about" */ '../views/Postmeida.vue'),
    meta:{requiredAuth: true}
  },

  {
    path: '/CreateShop',
    component: () => import(/* webpackChunkName: "about" */ '../views/CreateShop.vue'),
    meta:{requiredAuth: true}
  },

  {
    path: '/Shops',
    component: () => import(/* webpackChunkName: "about" */ '../views/ShopPage.vue'),
    meta:{requiredAuth: true}
  },

  {
    path: '/test1',
    component: () => import(/* webpackChunkName: "about" */ '../views/test1.vue'),
    meta:{requiredAuth: true}
  },

  //  {
  //   path: '/CreateShop',
  //   component: () => import(/* webpackChunkName: "about" */ '../views/CreateShop.vue'),
  //   meta:{requiredAuth: true}
  // },

  {
    path: '/Forgotpassword',
    component: () => import(/* webpackChunkName: "about" */ '../views/ForgotPassword.vue'),
 
  },



]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  const isLoggedin = checkUserLogin();
 if (to.matched.some((record) => record.meta.requiredAuth)) {
  if (!isLoggedin) {
    next('/');
  } else {
    next( );
  }
 }else{
  next();
 }
});

 function checkUserLogin(){
  const userToken = sessionStorage.getItem("verification_token");
  return !!userToken;
}

export default router

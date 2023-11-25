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
     component: () => import(/* webpackChunkName: "about" */ '../views/RegistrationPage.vue')
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
    component: () => import(/* webpackChunkName: "about" */ '../views/HomeView.vue')
  },
  {
    path: '/Market',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/MarketPage.vue')
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
    path: '/ProdForm',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/ProductFormView.vue'),
    meta:{requiredAuth: true}
    },
  {
    path: '/EditProf',
    component: () => import(/* webpackChunkName: "about" */ '../views/EditProfile.vue')
  },
  {
    path: '/ProfEvent',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Eventprofile.vue')
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
    next();
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

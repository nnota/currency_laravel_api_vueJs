import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginView from "../views/LoginView.vue";



// function checkLogin() {
//   if (localStorage.getItem("access_token") == null){
//     return { path: "/login"}
// };

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),

  routes: [
    {
      path: '/',
      redirect: {
          name: "login"
      }
    },
    {
      path: "/admin",
      name: "admin",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/AdminView.vue"),
      // beforeEnter: checkLogin,
      beforeEnter() {
        if (localStorage.getItem("access_token") == null){
              return { path: "/login"}
        }
      }
    },
    {
      path: "/login",
      name: "login",
      component: LoginView,
    },
    {
      path: "/admin/currencies",
      name: "currencies",
      component: () => import("../views/CurrenciesView.vue"),
    },
    {
      path: "/admin/pairs",
      name: "pairs",
      component: () => import("../views/PairsView.vue"),
    },
  ],
});

export default router;

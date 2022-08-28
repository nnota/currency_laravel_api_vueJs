import { createRouter, createWebHistory } from "vue-router";
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
      path: "/login",
      name: "login",
      component: LoginView,
      beforeEnter() {
        if (localStorage.getItem("access_token") != null){
              return { path: "/admin/currencies"}
        }
      },
    },
    {
      path: "/admin/currencies",
      name: "currencies",
      component: () => import("../views/CurrenciesView.vue"),
      beforeEnter() {
        if (localStorage.getItem("access_token") == null){
              return { path: "/login"}
        }
      },
    },
    {
      path: "/admin/pairs",
      name: "pairs",
      component: () => import("../views/PairsView.vue"),
      beforeEnter() {
        if (localStorage.getItem("access_token") == null){
              return { path: "/login"}
        }
      }
    },
  ],
});

export default router;

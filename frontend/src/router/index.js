import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
    path: "/reports-add",
    alias: "/reports-add",
    name: "reports-add",
    component: () => import("../views/reports/ReportAddView.vue")
    },
    {
    path: "/reports-edit",
    alias: "/reports-edit",
    name: "reports-edit",
    component: () => import("../views/reports/ReportEditView.vue")
    },
    // {
    // path: "/report/:id",
    // name: "report-details",
    // component: () => import("./components/Tutorial")
    // },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    }
  ]
})

export default router

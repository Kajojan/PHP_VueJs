import { createRouter, createWebHistory } from 'vue-router'
import MainPage from '@/components/MainPage'
import SpreadSheets from '@/components/SpreadSheets'


const routes = [
  {
    path: '/',
    name: 'mainPage',
    component: MainPage
  },
  {
    path: '/spreadsheets',
    name: 'spreadsheets',
    props: true,
    component: SpreadSheets
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
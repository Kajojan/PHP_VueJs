import { createRouter, createWebHistory } from 'vue-router'
import MainPage from '@/components/MainPage'
import SpreadSheets from '@/components/SpreadSheets'
import SpreadDetail from '@/components/SpreadDetail'


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
  {
    path: '/details/:id',
    name: 'details',
    component: SpreadDetail
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
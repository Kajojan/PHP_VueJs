import { createRouter, createWebHistory } from 'vue-router'
import MainPage from '@/components/MainPage'
import SpreadSheets from '@/components/SpreadSheets'
import SpreadDetail from '@/components/SpreadDetail'
import SheetsDetail from '@/components/SheetsDetail'



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
  {
    path: '/details/:id/:sheet',
    name: 'sheets',
    component: SheetsDetail
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
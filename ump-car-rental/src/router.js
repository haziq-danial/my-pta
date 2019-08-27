import Vue from 'vue'
import Router from 'vue-router'
import Redirect from './views/Redirect.vue'
import Testing from './views/Testing.vue'
import Testing2 from './views/Testing2.vue'
import Testing3 from './views/Testing3.vue'
import Testing4 from './views/Testing4.vue'
import PageNotFound from './views/PageNotFound.vue'

//login pages
import Login from './views/login/Login.vue'
import StudentLogin from './views/login/StudentLogin.vue'
import CarOwnerLogin from './views/login/CarOwnerLogin.vue'

//register pages
import StudentRegister from './views/register/StudentRegister.vue'
import CarOwnerRegister from './views/register/CarOwnerRegister.vue'
import Register from './views/register/Register.vue'

//student-related pages
import MainPage from './views/student/MainPage.vue'
import AllCar from './views/student/AllCar.vue'
import CarDetail from "./views/student/CarDetail.vue"
import StudentPage from "./views/student/StudentPage.vue"
import SearchCar from "./views/student/SearchCar.vue"
import CarBookingPage from "./views/student/CarBookingPage.vue"

//car-owner pages
import MainPageOwner from "./views/car-owner/MainPageOwner.vue"
import Dashboard from "./views/car-owner/Dashboard.vue"
import CarOwnerPage from "./views/car-owner/CarOwnerPage.vue"
import CustomerPage from "./views/car-owner/CustomerPage.vue"
import CarRegister from "./views/car-owner/CarRegister.vue"




Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      redirect: '/login/student-login',
      name: 'redirect',
      component: Redirect
    },
    //login & register
    {
      path: '/login',
      name: 'login',
      component: Login,
      children: [
        {
          path: 'student-login',
          component: StudentLogin
        },
        {
          path: 'owner-login',
          component: CarOwnerLogin
        }
      ]
    },
    {
      path: '/register',
      name: 'register',
      component: Register,
      children: [
        {
          path: 'student-register',
          component: StudentRegister
        },
        {
          path: 'owner-register',
          component: CarOwnerRegister
        }
      ]
    },
    //student routes
    {
      path: '/student/main-page',
      name: 'main-page',
      component: MainPage,
      children: [
        {
          path: 'all-car',
          component: AllCar,
          
        },
        {
          path: 'car-details/:matric_no',
          component: CarDetail,
          meta: {
            scrollToTop: true
          }
        },
        {
          path: 'profile',
          component: StudentPage
        },
        {
          path: 'search',
          component: SearchCar
        },
        {
          path: 'bookings',
          component: CarBookingPage
        }
      ]
    },
    //car-owner routes
    {
      path: '/car-owner/main-page',
      name: 'MainPageOwner',
      component: MainPageOwner,
      children: [
        {
          path: 'dashboard',
          component: Dashboard
        },
        {
          path: 'profile',
          component: CarOwnerPage
        },
        {
          path: 'customer',
          component: CustomerPage
        },
        {
          path: 'car-register',
          component: CarRegister
        }
      ]
    },
    {
      path: '/test',
      name: 'test',
      component: Testing
    },
    {
      path: '/test2',
      name: 'test2',
      component: Testing2
    },
    {
      path: '/test3',
      name: 'test3',
      component: Testing3
    },
    {
      path: '/test4',
      name: 'test4',
      component: Testing4
    },
    {
      path: '*',
      component: PageNotFound
    }
  ]
})

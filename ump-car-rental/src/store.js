import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    student: {},
    car_owner: {},
    booking: {},
    car_book: {},
    isBooking: false,
  },
  getters: {
    student: (state) => {
      return state.student
    },
    car_owner: (state) => {
      return state.car_owner
    },
    booking: (state) => {
      return state.booking
    },
    car_book: (state) => {
      return state.car_book
    },
    isBooking: (state) => {
      return state.isBooking
    }
  },
  mutations: {
    SET_STUDENT: (state, newStudent) => {
      state.student = newStudent
    },
    SET_STUDENT_EMPTY: (state) => {
      state.student = {}
    },
    SET_CAR_OWNER: (state, newowner) => {
      state.car_owner = newowner
    },
    SET_CAR_OWNER_EMPTY: (state) => {
      state.car_owner = {}
    },
    IS_EMPTY : (obj) => {
      for(var key in obj) {
        if(obj.hasOwnProperty(key)){
          return false
        }
      }
      return true
    },
    SET_BOOKING: (state, newBooking) => {
      state.booking = newBooking
      state.isBooking = true
    },
    SET_BOOKING_EMPTY: (state) => {
      state.booking = {}
      state.isBooking = false
    },
    SET_CAR_BOOK: (state, newCarBook) => {
      state.car_book = newCarBook
    },
    SET_CAR_BOOK_EMPTY: (state) => {
      state.car_book = {}
    }
  },
  actions: {
    setStudent: ({commit}, newStudent) => {
      commit('SET_STUDENT', newStudent)
    },
    setCarBook: ({commit}, newCarBook) => {
      commit('SET_CAR_BOOK', newCarBook)
    },
    setCarOwner: ({commit}, newOwner) => {
      commit('SET_CAR_OWNER', newOwner)
    },
    setBooking: ({commit}, newBooking) => {
      commit('SET_BOOKING', newBooking)
    },
    setStudentEmpty: ({commit}) => {
      commit('SET_STUDENT_EMPTY')
    },
    setCarOwnerEmpty: ({commit}) => {
      commit('SET_CAR_OWNER_EMPTY')
    },
    isEmpty: ({commit}, obj) => {
      commit('IS_EMPTY', obj)
    },
    setBookingEmpty: ({commit}) => {
      commit('SET_BOOKING_EMPTY')
    },
    setCarBookEmpty: ({commit}) => {
      commit('SET_CAR_BOOK_EMPTY')
    }
  }
})

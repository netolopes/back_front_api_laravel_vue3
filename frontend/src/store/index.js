import { createStore, createLogger } from 'vuex';
import report from './modules/Report';

//const debug = process.env.NODE_ENV !== 'production'

const Store = createStore({
  modules: {
    report
  },
  strict:true
//   strict: debug,
//   plugins: debug ? [createLogger()] : []
})

export default Store;
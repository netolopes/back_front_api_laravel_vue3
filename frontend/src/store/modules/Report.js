// import { GET_ALL_PRODUCTS } from "./Types";
import axios from 'axios';
import http from "../../http-common";
// initial state
const state = () => ({
  reports: [],
  last_page:null,
   reportsPaginatedData: null,
   report: null,
   isLoading: false,
   isCreating: false,
   createdData: null,
  isUpdating: false,
  updatedData: null,
  isDeleting: false,
  deletedData: null
})

// getters
const getters = {
  reportList: state => state.reports,
  reportLastPage: state => state.last_page,
   reportsPaginatedData: state => state.reportsPaginatedData,
   report: state => state.report,
   isLoading: state => state.isLoading,
   isCreating: state => state.isCreating,
   isUpdating: state => state.isUpdating,
   createdData: state => state.createdData,
   updatedData: state => state.updatedData,

  isDeleting: state => state.isDeleting,
  deletedData: state => state.deletedData
};


// mutations
const mutations = {
  setReports: (state, reports) => {
    state.reports = reports
  },

  setLastPage: (state, last_page) => {
    state.last_page = last_page
  },

  setReportsPaginated: (state, reportsPaginatedData) => {
    state.reportsPaginatedData = reportsPaginatedData
  },

  setReportDetail: (state, report) => {
    state.report = report
  },

  setDeleteReport: (state, id) => {
    state.reportsPaginatedData.data.filter(x => x.id !== id);
 
  },

  setReportDetailInput: (state, e) => {
    let report = state.report;
    report[e.target.name] = e.target.value;
    state.report = report
  },

  saveNewReports: (state, report) => {
  //  console.log([report])
   state.reports.unshift([report])
   state.createdData = report;
  },

  saveUpdatedReport: (state, report) => {
    state.reports.unshift([report])
    state.updatedData = report;
  },

  setReportIsLoading(state, isLoading) {
    state.isLoading = isLoading
  },

  setReportIsCreating(state, isCreating) {
    state.isCreating = isCreating
  },

  setReportIsUpdating(state, isUpdating) {
    state.isUpdating = isUpdating
  },

  setReportIsDeleting(state, isDeleting) {
    state.isDeleting = isDeleting
  },

}


// actions
const actions = {
   async fetchAllReports({ commit }, query = null) {
    let page = '';
    let search = '';
    if(query !== null){
      page = query.page;
      search = query.search;
    }

    // commit('setReportIsLoading', true);
     let url = '';
    // if (search !== '') {
      url = `/report/?page=${query.page}&search=${query.search}`;
    // } else {
    //     url = `/report/?page=${query.page}&search=${query.search}`;
    // }
  

   await http.get(url)
    .then(response => {
      const reports = response.data;
      const last_page = response.data.last_page;
      commit('setReports', reports);
      commit('setLastPage', last_page);
   //   console.log(response.data);
    })
    .catch(e => {
      console.log(e);
    });
   


  //   await axios.get(url)
  //     .then(res => {
  //       const reports = res.data.data.data;
  //       commit('setReports', reports);
  //       const pagination = {
  //         total: res.data.data.total,  // total number of elements or items
  //         per_page: res.data.data.per_page, // items per page
  //         current_page: res.data.data.current_page, // current page (it will be automatically updated when users clicks on some page number).
  //         total_pages: res.data.data.last_page // total pages in record
  //       }
  //       res.data.data.pagination = pagination;
  //       commit('setReportsPaginated', res.data.data);
  //       commit('setReportIsLoading', false);
  //     }).catch(err => {
  //       console.log('error', err);
  //       commit('setReportIsLoading', false);
  //     });
   },

  async fetchDetailReport({ commit }, id) {
    commit('setReportIsLoading', true);
    await http.get(`/report/show/${id}`)
      .then(res => {
        commit('setReportDetail', res.data);
        commit('setReportIsLoading', false);
      }).catch(err => {
        console.log('error', err);
        commit('setReportIsLoading', false);
      });
  },

  async storeReport({ commit }, report) {
    commit('setReportIsCreating', true);
 // console.log('error', report);
    await http.post('/report/create', report)
      .then(res => {
        commit('saveNewReports', res.data);
        commit('setReportIsCreating', false);
      }).catch(err => {
        console.log('error', err);
        commit('setReportIsCreating', false);
      });
  },

  async updateReport({ commit }, report) {
    commit('setReportIsUpdating', true);
    commit('setReportIsUpdating', true);
    await http.put('/report/edit', report)
      .then(res => {
        commit('saveUpdatedReport', res.data);
        commit('setReportIsUpdating', false);
      }).catch(err => {
        console.log('error', err);
        commit('setReportIsUpdating', false);
      });
  },


  async deleteReport({ commit }, id) {
  //  commit('setReportIsDeleting', true);

    await http.delete(`/report/delete/${id}`)
      .then(res => {
     //    commit('setDeleteReport', res.data.id);
         commit('setReportIsDeleting', false);
      }).catch(err => {
        console.log('error', err);
        commit('setReportIsDeleting', false);
      });
  },

  updateReportInput({ commit }, e) {
    commit('setReportDetailInput', e);
  }
}



export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}


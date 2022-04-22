<template>
  <div class="container">
    <div class="row justify-content-center mt-2 mb-2">
      <div class="col-12">
        <h4 class="text-left mb-2">All Reports  </h4>
      </div>
      <div  class="col-10">
        <input 
          type="text"
          class="form-control"
          placeholder="Search..."
          @input="getAllReports"
          v-model="query.search"
        />
      </div>
       <div  class="col-2">
       
       <RouterLink to="/reports-add">Add</RouterLink>
     
      </div>
    </div>
    <div class="">
      <div class="" >
        <div class="row border-bottom border-top p-2 ">
          <div class="col-1">Id</div>
          <div class="col-2">Title</div>
          <div class="col-2">Category</div>
          <div class="col-3">Description</div>
          <div class="col-2">User</div>
          <div class="col-2">Options</div>
        </div>

        <div v-for="(item, index) in reportList.data" :key="item.id">
          <report-detail :index="index" :arr="item" />
        </div>
      </div>

      <!-- div v-if="isLoading" class="text-center mt-5 mb-5">
        Loading Products...
        <div class="spinner-grow" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div -->
    </div>

    <!-- Insert Pagination Part -->
    <div  class="vertical-center mt-2 mb-5">
      <v-pagination
        v-model="query.page"
        :pages="reportLastPage"
        active-color="#DCEDFF"
        @update:modelValue="getAllReports"
      />
    </div>
  </div>
</template>



<script>
import ReportDetail from "@/components/reports/ReportDetail.vue"
import ReportService from "../../services/ReportService";
import VPagination from "@hennge/vue3-pagination";
import { mapGetters,mapActions,mapState } from 'vuex'
export default {
  name: "reports-list",
  data() {
    return {
    //  reports: [],
      currentReport: null,
      currentIndex: -1,
      title: "",
       query: {
        page: 1,
        search: "",
      },
    };
  },
  components: {
    ReportDetail,
    VPagination
  },
  computed:{
 ...mapGetters(["reportList","reportLastPage"]),
 ...mapState(["last_page"])

  },
  methods: {
    ...mapActions(["fetchAllReports"]),
     getAllReports() {
      //  console.log(this.query)
       this.fetchAllReports(this.query)
    },
    // refreshList() {
    // return  this.getAllReports();
    //   this.currentReport = null;
    //   this.currentIndex = -1;
    // },
    // setActiveTutorial(tutorial, index) {
    //   this.currentReport = tutorial;
    //   this.currentIndex = tutorial ? index : -1;
    // },
    // removeAllTutorials() {
    //   ReportService.deleteAll()
    //     .then(response => {
    //       console.log(response.data);
    //       this.refreshList();
    //     })
    //     .catch(e => {
    //       console.log(e);
    //     });
    // },
    
    searchTitle() {
      ReportService.findByTitle(this.title)
        .then(response => {
          this.reports = response.data;
       //   this.setActiveTutorial(null);
        //  console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
 
  mounted() {
    this.getAllReports();
    
  }
};
</script>
<style>
.list {
  text-align: left;
  max-width: 750px;
  margin: auto;
}
</style>
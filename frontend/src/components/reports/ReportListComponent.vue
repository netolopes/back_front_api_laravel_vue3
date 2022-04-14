<template>
  <div class="container">
    <div class="row justify-content-center mt-2 mb-2">
      <div class="col-8">
        <h4 class="text-left mb-2">All Products</h4>
      </div>
      <!-- div class="col-4">
        <input
          type="text"
          class="form-control"
          placeholder="Search Products..."
          @input="searchProducts"
          v-model="query.search"
        />
      </div -->
    </div>
    <div class="">
      <div class="" >
        <div class="row border-bottom border-top p-2 bg-light">
          <div class="col-1">Sl</div>
          <div class="col-3">Title</div>
          <div class="col-2">category</div>
        </div>

        <div v-for="(item, index) in tutorials.dados" :key="item.id">
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
    <!-- div v-if="productsPaginatedData !== null" class="vertical-center mt-2 mb-5">
      <v-pagination
        v-model="query.page"
        :pages="productsPaginatedData.pagination.total_pages"
        :range-size="2"
        active-color="#DCEDFF"
        @update:modelValue="getResults"
      />
    </div -->
  </div>
</template>



<script>
import ReportDetail from "@/components/reports/ReportDetail.vue"
import ReportService from "../../services/ReportService";
import VPagination from "@hennge/vue3-pagination";
export default {
  name: "tutorials-list",
  data() {
    return {
      tutorials: [],
      currentTutorial: null,
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
  methods: {
    retrieveTutorials() {
      ReportService.getAll()
        .then(response => {
          this.tutorials = response.data;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },
    refreshList() {
      this.retrieveTutorials();
      this.currentTutorial = null;
      this.currentIndex = -1;
    },
    setActiveTutorial(tutorial, index) {
      this.currentTutorial = tutorial;
      this.currentIndex = tutorial ? index : -1;
    },
    removeAllTutorials() {
      ReportService.deleteAll()
        .then(response => {
          console.log(response.data);
          this.refreshList();
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    searchTitle() {
      ReportService.findByTitle(this.title)
        .then(response => {
          this.tutorials = response.data;
          this.setActiveTutorial(null);
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.retrieveTutorials();
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
<template>
  <div :id="'linha'+arr.id" class="row border-1 p-2">
    <div class="col-1 text-left">{{ arr.id }}</div>
    <div class="col-2">{{ arr.title }}</div>
    <div class="col-2">{{ arr.category }} </div>
    <div class="col-3">{{ arr.description }}</div>
    <div class="col-2">{{ arr.users.name }}</div>
    <div class="col-2">
   
      <!-- <router-link
        :to="{ name: 'reports-edit', params: { id: arr.id } }"
      > -->
      <router-link
        :to="{ name: 'reports-edit', query: { id: arr.id } }"
        class="btn btn-primary"
        title="Edit"
        >
        <i class="fa fa-pencil"></i></router-link
      >

      <button class="btn btn-danger ml-2" @click="deleteReportModal(arr.id)" title="Delete">
         <i class="fa fa-trash"></i>
      </button> 
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "ReportDetail",
  props: {
    arr: {
      type: Object,
    },
    index: {
      type: Number,
    },
  },
   computed: { ...mapGetters(["isDeleting", "deletedData"]) },
  methods: {
    ...mapActions(["deleteReport", "fetchAllReports"]),
    deleteReportModal(id) {
      this.$swal
        .fire({
          text: "Are you sure to delete the report ?",
          icon: "error",
          cancelButtonText: "Cancel",
          confirmButtonText: "Yes, Confirm Delete",
          showCancelButton: true,
        })
        .then((result) => {
          if (result["isConfirmed"]) {
            // Put delete logic
            this.deleteReport(id);
       
        const linha = document.getElementById('linha'+id);
        linha.style.display = 'none';

            this.$swal.fire({
              text: "Success, report has been deleted.",
              icon: "success",
              position: 'top-end',
              timer: 1000,
            });
            
          }
        });
    },
  },
};
</script>

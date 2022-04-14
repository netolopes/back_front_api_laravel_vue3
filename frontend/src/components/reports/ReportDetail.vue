<template>
  <div class="row border-1 p-2">
    <div class="col-1 text-left">{{ index + 1 }}</div>
    <div class="col-3">{{ arr.title }}</div>
    <div class="col-2">
      <strong class="text-danger">{{ arr.title }} $</strong>
    </div>
    <div class="col-3">
      <span class="badge badge-info">{{ arr.category }}</span>
    </div>
    <div class="col-2">
      <!-- router-link
        :to="{ name: 'ProductEdit', params: { id: arr.id } }"
        class="btn btn-primary"
        title="Edit Product"
        >
        <i class="fa fa-pencil"></i></router-link
      >
      <button class="btn btn-danger ml-2" @click="deleteProductModal(product.id)" title="Delete Product">
         <i class="fa fa-trash"></i>
      </button -->
    </div>
  </div>
</template>

<script>
//import { mapGetters, mapActions } from "vuex";
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
//   computed: { ...mapGetters(["isDeleting", "deletedData"]) },
//   methods: {
//     ...mapActions(["deleteProduct", "fetchAllProducts"]),
//     deleteProductModal(id) {
//       this.$swal
//         .fire({
//           text: "Are you sure to delete the product ?",
//           icon: "error",
//           cancelButtonText: "Cancel",
//           confirmButtonText: "Yes, Confirm Delete",
//           showCancelButton: true,
//         })
//         .then((result) => {
//           if (result["isConfirmed"]) {
//             // Put delete logic
//             this.deleteProduct(id);
//             this.fetchAllProducts({
//               page: 1,
//               search: ''
//             });
//             this.$swal.fire({
//               text: "Success, Product has been deleted.",
//               icon: "success",
//               position: 'top-end',
//               timer: 1000,
//             });
//           }
//         });
//     },
//   },
};
</script>

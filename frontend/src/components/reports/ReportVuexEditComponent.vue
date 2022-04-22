
<template>
  <div class="container">
    <div class="card">
      <div style="color:#000" class="card-header">
        <h6>Edit Report{{id}}</h6>
      </div>
      <div style="color:#000" class="card-body">
        <Form @submit="onSubmit" :validation-schema="schema">
          <div v-if="isLoading">
            <div class="text-center">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <br />
              Loading Report Details
            </div>
          </div>
          <div v-if="report !== null && !isLoading">
            <div class="form-group row">
              <div class="col-12">
                <label>Report Title:</label>
                <Field
                  id="title"
                  name="title"
                  type="text"
                  class="form-control"
                  :value="report.title"
                  @input="updateReportInputAction"
                />
                <ErrorMessage name="title" class="text-danger" />
              </div>
              <div class="col-12">
                <label>Report Category:</label>
                <Field
                  name="category"
                  type="text"
                  class="form-control"
                  :value="report.category"
                  @input="updateReportInputAction"
                />
                <ErrorMessage name="category" class="text-danger" />
              </div>
            </div>
            <div class="form-group row">
              <div class="col-12">
                <label>Report Details:</label>
                <Field
                  name="description"
                  as="textarea"
                  class="form-control"
                  :value="report.description"
                  @input="updateReportInputAction"
                />
                <ErrorMessage name="description" class="text-danger" />
              </div>
            </div>
             <div class="form-group row">
              <div class="col-12">
                <label>Report User:</label>
                <select
                  name="user"
                  class="form-control"
                >
           
                <option v-for="item in users.data" :value="item.id"   :key="item.id" :selected="item.id == report.user_id"  >{{ item.name }}</option> 
                </select>
                
                <ErrorMessage name="user" class="text-danger" />
              </div>
            </div>
            <div class="form-group">
              <router-link to="/" class="btn btn-secondary mr-2"
                >Cancel</router-link
              >
              <input
                type="submit"
                class="btn btn-primary"
                value="Save Update"
                v-if="!isUpdating"
              />
              <button class="btn btn-primary" type="button" disabled v-if="isUpdating">
                <span
                  class="spinner-border spinner-border-sm"
                  role="status"
                  aria-hidden="true"
                ></span>
                Saving...
              </button>
            </div>
          </div>
        </Form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { Field, Form, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import UserService from "../../services/UserService";

export default {
  data() {
    return {
      id: null,
      users:[]
    };
  },
  components: {
    Field,
    Form,
    ErrorMessage,
  },
  created: function () {
    this.id = this.$route.query.id;
    this.fetchDetailReport(this.id);
    this.getAllReports();
  },
  computed: { ...mapGetters(["isUpdating", "updatedData", "report", "isLoading"]) },
  methods: {
    ...mapActions(["updateReport", "updateReportInput", "fetchDetailReport"]),
    onSubmit() {
      const { title, category, description,user_id } = this.report;
      // return false;
      this.updateReport({
        id: this.id,
        title: title,
        category: category,
        description: description,
        user_id: user_id
      });
    },
    updateReportInputAction(e) {
      this.updateReportInput(e);
    },
    getAllReports() {
      UserService.getAll()
        .then(response => {
          this.users = response.data;
       //   console.log(this.users);
        })
        .catch(e => {
          console.log(e);
        });
    },
  },
  watch: {
    updatedData: function () {
      if (this.updatedData !== null && !this.isUpdating) {
        this.$swal.fire({
          text: "Success, Report has been updated successfully !",
          icon: "success",
          position: "top-end",
          timer: 1000,
        });
        this.$router.push({ name: "home" });
      }
    },
  },
  setup() {
    // Define a validation schema
    const schema = yup.object({
      title: yup.string().required().min(5),
      category: yup.string().required(),
      description: yup.string().required().min(5),
    });
    return {
      schema
    };
  },
};
</script>
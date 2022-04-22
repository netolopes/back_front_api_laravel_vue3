<template>
  <div  class="container">
    <div class="card">
      <div style="color:#000" class="card-header">
        <h6>Add Report</h6>
      </div>
      <div style="color:#000" class="card-body">
        <!-- <form v-on:submit.prevent="onSaveProduct" :validation-schema="schema"> -->
        <Form @submit="onSubmit" :validation-schema="schema">
          <!-- <Form @submit="onSaveProduct" :validation-schema="schema"> -->
          <div class="form-group row">
            <div class="col-12">
              <label>Title:</label>
              <Field
                id="title"
                name="title"
                type="text"
                class="form-control"
                v-model="report.title"
              />
              <ErrorMessage name="title" class="text-danger" />
            </div>
            <div class="col-12">
              <label>Category:</label>
              <Field
                name="category"
                type="text"
                class="form-control"
                v-model="report.category"
              />
              <ErrorMessage name="category" class="text-danger" />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12">
              <label>Description:</label>
              <Field
                name="description"
                as="textarea"
                class="form-control"
                v-model="report.description"
               />
              <ErrorMessage name="description" class="text-danger" />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12">
              <label>User:</label>
              <Field
                name="user_id"
                type="number"
                class="form-control"
                v-model="report.user_id"
               />
              <ErrorMessage name="user_id" class="text-danger" />
            </div>
          </div>
          <div class="form-group">
            <router-link to="/" class="btn btn-secondary mr-2"
              >Cancel</router-link
            >
            <input
              type="submit"
              class="btn btn-primary"
              value="Add Report"
              v-if="!isCreating"
            />
            <button class="btn btn-primary" type="button" disabled v-if="isCreating">
              <span
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
              ></span>
              Saving...
            </button>
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
export default {
  data() {
    return {
      report: {}
    };
  },
  components: {
    Field,
    Form,
    ErrorMessage,
  },
  computed: { ...mapGetters(["isCreating", "createdData"]) },
  methods: {
    ...mapActions(["storeReport"]),
    onSubmit() {
      const { title, category, description,user_id } = this.report;
      this.storeReport({
        title: title,
        category: category,
        description: description,
        user_id: user_id
      });
    }
  },
  watch: {
    createdData: function () {
      if (this.createdData !== null && !this.isCreating) {
        this.$swal.fire({
          text: "Success, Report has been added.",
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
      title: yup.string().required(),
      category: yup.string().required(),
      description: yup.string().required(),
    });
    return {
      schema
    };
  },
};
</script>
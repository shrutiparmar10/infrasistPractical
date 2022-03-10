<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" v-if="!editMode">Add Employee</h3>
            <h3 class="card-title" v-if="editMode">Edit Employee</h3>
          </div>
          <form
            @submit.prevent="editMode ? updateEmployee() : createEmployee()"
          >
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="name"
                    >Name<span style="color: red">*</span></label
                  >
                  <input
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    id="name"
                    placeholder="Enter Name"
                  />
                  <div v-if="feedback.name">
                      <span style="color:red" v-text="feedback.name[0]"/>
                  </div>
                </div>
                <div class="col-md-6 form-group">
                  <label for="exampleInputEmail1"
                    >Email<span style="color: red">*</span></label
                  >
                  <input
                    v-model="form.email"
                    type="email"
                    class="form-control"
                    id="exampleInputEmail1"
                    placeholder="Enter email"
                  />
                  <div v-if="feedback.email">
                      <span style="color:red" v-text="feedback.email[0]"/>
                  </div>
                </div>
                <div class="col-md-4 form-group">
                  <label for="country"
                    >Country<span style="color: red">*</span></label
                  >
                  <multiselect
                    v-model="form.country"
                    :options="this.countryOption"
                    :allow-empty="false"
                    label="name"
                    placeholder="select country"
                  >
                  </multiselect>
                  <div v-if="feedback.country">
                      <span style="color:red" v-text="feedback.country[0]"/>
                  </div>
                </div>
                <div class="col-md-4 form-group">
                  <label for="state"
                    >State<span style="color: red">*</span></label
                  >
                  <multiselect
                    v-model="form.state"
                    :options="this.stateOption"
                    :allow-empty="false"
                    label="name"
                    placeholder="select state"
                  >
                  </multiselect>
                  <div v-if="feedback.state">
                      <span style="color:red" v-text="feedback.state[0]"/>
                  </div>
                </div>
                <div class="col-md-4 form-group">
                  <label for="city"
                    >City<span style="color: red">*</span></label
                  >
                  <multiselect
                    v-model="form.city"
                    :options="this.cityOption"
                    :allow-empty="false"
                    label="name"
                    placeholder="select city"
                  >
                  </multiselect>
                  <div v-if="feedback.city">
                      <span style="color:red" v-text="feedback.city[0]"/>
                  </div>
                </div>
                <div class="col-md-4 form-group">
                  <label for="mobile_number"
                    >Contact<span style="color: red">*</span></label
                  >
                  <input
                    v-model="form.mobile_number"
                    type="text"
                    class="form-control"
                    id="mobile_number"
                    placeholder="Enter Mobile"
                  />
                  <div v-if="feedback.mobile_number">
                      <span style="color:red" v-text="feedback.mobile_number[0]"/>
                  </div>
                </div>
                <div class="col-md-4 form-group">
                  <label for="address1"
                    >Address 1<span style="color: red">*</span></label
                  >
                  <input
                    v-model="form.address_line1"
                    type="text"
                    class="form-control"
                    id="address1"
                    placeholder="Enter Address"
                  />
                  <div v-if="feedback.address_line1">
                      <span style="color:red" v-text="feedback.address_line1[0]"/>
                  </div>
                </div>
                <div class="col-md-4 form-group">
                  <label for="address2">Address 2</label>
                  <input
                    v-model="form.address_line2"
                    type="text"
                    class="form-control"
                    id="address2"
                    placeholder="Enter Address"
                  />
                </div>
                <div class="col-md-12 form-group">
                  <div>
                    <label for="address2"
                      >Image<span style="color: red">*</span></label
                    >
                    <div>
                      <img
                        v-if="form.image != '' && form.image != null"
                        :src="getImage()"
                        height="80"
                        width="80"
                        ref="image"
                      />
                      <img
                        v-else
                        src="images\avatar-icon.jpg"
                        height="80"
                        width="80"
                        ref="image"
                      />
                    </div>
                  </div>
                  <div style="margin-top: 10px">
                    <label class="btn btn-primary" for="image-upload"
                      >Upload</label
                    >
                    <input
                      type="file"
                      id="image-upload"
                      accept=".jpg,.png"
                      name="image"
                      hidden
                      @change="uploadImage"
                    />
                  </div>
                   <div v-if="feedback.image">
                      <span style="color:red" v-text="feedback.image[0]"/>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer">
              <button v-if="!editMode" type="submit" class="btn btn-primary">
                Submit
              </button>
              <button v-if="editMode" type="submit" class="btn btn-primary">
                Edit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
export default {
  components: { Multiselect },
  data() {
    return {
      form: new Form({
        country: "",
        state: "",
        city: "",
        image: "",
        name: "",
        email: "",
        mobile_number: "",
        address_line1: "",
        address_line2: "",
      }),
      countryOption: [],
      stateOption: [],
      cityOption: [],
      employeeData: {},
      editMode: false,
      feedback: "",
      image_file_extension: ["image/png", "image/jpg", "image/jpeg"],
    };
  },
  methods: {
    uploadImage(e) {
      let file = e.target.files[0];
      if (this.image_file_extension.includes(file["type"])) {
        let reader = new FileReader();
        reader.onloadend = (file) => {
          this.form.image = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        alert("only png, jpeg jpg image allow");
      }
    },
    createEmployee() {
      axios
        .post("employee", {
          country: this.form.country.id,
          state: this.form.state.id,
          city: this.form.city.id,
          image: this.form.image,
          name: this.form.name,
          email: this.form.email,
          mobile_number: this.form.mobile_number,
          address_line1: this.form.address_line1,
          address_line2: this.form.address_line2,
        })
        .then((response) => {
          alert("Employee Added Successfully");
          this.$router.push({
            name: "employee",
          });
        })
        .catch((error) => {
          this.feedback = error.response.data.errors;
          alert("your request failed");
        });
    },
    getImage() {
      let image =
        this.form.image.length > 200
          ? this.form.image
          : "images/employee/" + this.form.image;
      return image;
    },
    loadCountry() {
      axios
        .get("loadCountry")
        .then(({ data }) => {
          this.countryOption = data;
        })
        .catch(() => {});
    },
    loadState() {
      axios
        .get("loadState")
        .then(({ data }) => {
          this.stateOption = data;
        })
        .catch(() => {});
    },
    loadCity() {
      axios
        .get("loadCity")
        .then(({ data }) => {
          this.cityOption = data;
        })
        .catch(() => {});
    },
  },
  created() {
    this.loadCountry();
    this.loadState();
    this.loadCity();
  },
};
</script>

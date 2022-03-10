<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Employee List</h3>
            <div style="text-align:right"><router-link to="/add-employee"><button class="btn btn-success">Add New Employee</button></router-link></div>
          </div>

          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Country</th>
                  <th>State</th>
                  <th>City</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="emp in employeeData" :key="emp.id">
                  <td>{{emp.name}}</td>
                  <td>{{emp.email}}</td>
                  <td>
                      {{emp.mobile_number}}
                  </td>
                  <td>{{emp.country}}</td>
                  <td>{{emp.state}}</td>
                  <td>{{emp.city}}</td>
                  <td>{{emp.address_line1}}</td>
                  <td><a style="color:blue" href="#">Edit</a> | <a style="color:red" href="#">Delete</a> </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
 data(){
     return {
         employeeData:{},
     }
 },
 methods:{
     loadEmployee(){
         axios
         .get("employee")
         .then(({data})=>{
             this.employeeData = data;
         })
         .catch(()=>{});
     }
 },
  created() {
    this.loadEmployee();
  },
};
</script>

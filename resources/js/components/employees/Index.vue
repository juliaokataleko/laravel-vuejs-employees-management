<template>
  <div class="card">
    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
      <h5 class="h3 mb-0 text-gray-800">Employees</h5>
      <form method="GET" action="">
        <div class="form-row align-items-center">
          <div class="col">
            <input
              type="search"
              name="search"
              class="form-control"
              value=""
              id="inlineFormInput"
              placeholder="Search countries"
            />
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <router-link class="btn btn-primary" :to="{ name: 'EmployeesCreate' }"
        >Add Employee</router-link
      >
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-light">
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Address</th>
              <th scope="col">Department</th>
              <th scope="col">Salary</th>
              <th scope="col">Manage</th>
            </tr>
          </thead>
          <tbody v-if="employees.length > 0">
            <tr v-for="employee in employees" :key="employee.id">
              <td>#{{ employee.id }}</td>
              <td>{{ employee.first_name }}</td>
              <td>{{ employee.last_name }}</td>
              <td>{{ employee.address }}</td>
              <td>{{ employee.department.name }}</td>
              <td>{{ employee.sallary }}</td>
              <td>
                
                  <div class="btn-group">
                  <router-link :to="{name: 'EmployeesEdit', params: {id: employee.id}}" class="btn btn-primary"><i class="fa fa-edit"></i></router-link>
                    <button
                      type="submit"
                      @click="deleteEmployee(employee.id)"
                      class="btn btn-danger"
                    >
                      <i class="fa fa-times"></i>
                    </button>
                  </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      employees: []
    }
  },
  created() {
    this.getEmployees();
  },
  methods: {
    getEmployees() {

      axios.get(`/api/employees`).then(res => {
        this.employees = res.data.data;
        console.log(this.employees.length)
      }).catch(error => {
        console.log(error);
      });
      
    },
    deleteEmployee(id) {
      alert(id)
    }
  }
};
</script>

<style></style>

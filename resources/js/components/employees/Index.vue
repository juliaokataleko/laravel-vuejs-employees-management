<template>
  <div>
    <div v-if="showMessage">
        <div class="alert mb-3 alert-success">{{ message }}</div>
    </div>
    <div class="card">
      <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Employees</h5>
        <form method="GET" action="">
          <div class="form-row align-items-center">
            <div class="col">
              <label for="">Search</label>
              <input
                type="search"
                name="search"
                class="form-control form-control-sm"
                v-model.lazy="search"
                placeholder="Search employees"
              />
            </div>
            <div class="col">
                  <label for="department_id">Department</label>
                  <select v-model="department" name="department_id" 
                  id="department_id" class="form-control form-control-sm">
                    <option value="">Select</option>
                    <option v-for="dep in departments"  
                    :value="dep.id" 
                    :key="dep.id">{{ dep.name }}</option>
                  </select>
            </div>
            <!--
            <div class="col">
              <label for="">Go</label>
              <button type="submit" class="btn btn-primary btn-block btn-sm">
                <i class="fa fa-search"></i>
              </button>
            </div>-->
          </div>
        </form>
        <router-link class="btn btn-primary" :to="{ name: 'EmployeesCreate' }">Add Employee</router-link>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Country</th>
                <th scope="col">Address</th>
                <th scope="col">Department</th>
                <th scope="col">Manage</th>
                <th scope="col">Salary</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody v-if="employees.length > 0">
              <tr v-for="employee in employees" :key="employee.id">
                <td>#{{ employee.id }}</td>
                <td>{{ employee.first_name }}</td>
                <td>{{ employee.last_name }}</td>
                <td>{{ employee.country.name }}</td>
                <td>{{ employee.address }}</td>
                <td>{{ employee.department.name }}</td>
                <td>{{ employee.manager.first_name + ' ' + employee.manager.last_name }}</td>
                <td>{{ employee.sallary }}</td>
                <td>
                  
                    <div class="btn-group">
                    <router-link :to="{name: 'EmployeesEdit', params: {id: employee.id}}" class="btn btn-primary"><i class="fa fa-edit"></i></router-link>
                      <button
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      employees: [],
      showMessage: false,
      message: '',
      departments: [],
      search: null,
      department: null
    }
  },
  watch: {
    search() {
      this.getEmployees();
    },
    department() {
      this.getEmployees();
    }
  },
  created() {
    this.getEmployees();
    this.getDepartments()
  },
  methods: {
    getEmployees() {
      axios.get(`/api/employees`, {
        params: {
          search: this.search,
          department_id: this.department
        }
      }).then(res => {
        this.employees = res.data.data;
      }).catch(error => {
        console.log(error);
      });
    },
    deleteEmployee(id) {
      if(confirm("Are you sure?")) {
        axios.delete('/api/employees/'+id).then(res => {
          this.getEmployees();
          this.showMessage = true;
          this.message = res.data;

          setTimeout(() => {
            this.showMessage = false;
          }, 5000);

        }).catch(error => {
          console.log(error);
        });
      }      
    },
    getDepartments() {
      axios.get(`/api/employees/departments`).then(res => {
        this.departments = res.data;
      }).catch(error => {
        console.log(error);
      })
    }
  }
};
</script>

<style></style>

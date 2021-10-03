<template>
  <div class="card">
    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
      <h5 class="h3 mb-0 text-gray-800">Create a new Employee</h5>
      <router-link class="btn btn-primary" :to="{name: 'EmployeesIndex'}"><i class="fa fa-arrow-left"></i> Back</router-link>
    </div>

    <form  @submit.prevent="storeEmployer()" >

      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" class="form-control" 
                  value="" 
                  id="first_name" 
                  v-model="form.first_name"
                  name="first_name">
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label for="middle_name">Middle Name</label>
                  <input type="text" class="form-control" 
                  value="" 
                  id="middle_name" 
                  v-model="form.middle_name"
                  name="middle_name">
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="form-control" 
                  value="" 
                  id="last_name" 
                  v-model="form.last_name"
                  name="last_name">
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label for="sallary">Salary</label>
                  <input 
                  type="text" 
                  class="form-control"
                  value="" 
                  v-model="form.sallary"
                  v-money="money"
                  id="sallary" 
                  name="sallary">
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label for="birthdate">BirthDay</label>
                  <datepicker v-model="form.birthdate" input-class="form-control"></datepicker>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label for="date_hired">Hire Date</label>                    
                  <datepicker v-model="form.date_hired" input-class="form-control"></datepicker>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">

                  <label for="country_id">Country</label>
                  <select 
                  @change="getStates()"
                  v-model="form.country_id"
                  name="country_id" id="country_id" class="form-control">
                    <option v-for="country in countries"  
                    :value="country.id" 
                    :key="country.id">{{ country.name }}</option>
                  </select>

              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                  <label for="state_id">State</label>
                  <select 
                  @change="getCities()"
                  v-model="form.state_id"
                  name="state_id" 
                  id="state_id" class="form-control">
                    <option v-for="state in states"  
                    :value="state.id" 
                    :key="state.id">{{ state.name }}</option>
                  </select>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                  <label for="city_id">City</label>
                  <select 
                  v-model="form.city_id"
                  name="city_id" id="city_id" class="form-control">
                    <option v-for="city in cities"  
                    :value="city.id" 
                    :key="city.id">{{ city.name }}</option>
                  </select>
              </div>
          </div>

          <div class="col-md-12">
              <div class="form-group">
                  <label for="address">Address</label>
                  <input 
                  type="text" 
                  v-model="form.address"
                  class="form-control" 
                  value="" 
                  id="address" 
                  name="address">
              </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
                  <label for="zip_code">Zip Code</label>
                  <input 
                  v-model="form.zip_code"
                  type="text" class="form-control" 
                  value="" 
                  id="zip_code" 
                  name="zip_code">
              </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">

                  <label for="department_id">Department</label>
                  <select v-model="form.department_id" name="department_id" id="department_id" class="form-control">
                    <option v-for="dep in departments"  
                    :value="dep.id" 
                    :key="dep.id">{{ dep.name }}</option>
                  </select>

              </div>
          </div>

        </div>
      </div>

      <div class="card-footer">
        <div class="">
            <button type="submit"
            class="btn btn-primary">Save</button>
        </div>
      </div>

    </form>
    
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';
import {VMoney} from 'v-money'

export default {
  components: {
    Datepicker
  },
  data() {
    return {
      countries: [],
      states: [],
      cities: [],
      departments: [],
      form: {
        first_name: '',
        last_name: '',
        middle_name: '',
        address: '',
        country_id: '',
        state_id: '',
        city_id: '',
        department_id: '',
        zip_code: '',
        sallary: 10,
        birthdate: '',
        date_hired: '',
      },
      money: {
        decimal: ',',
        thousands: '.',
        prefix: 'R$ ',
        suffix: '',
        precision: 2,
        masked: false /* doesn't work with directive */
      }
    }
  },
  directives: {money: VMoney},
  created() {
    this.getCountries();
    this.getDepartments();
  },
  methods: {
    getCountries() {
      axios.get('/api/employees/countries').then(res => {
        this.countries = res.data;
      }).catch(error => {
        console.log(error);
      })
    },
    getStates() {
      axios.get(`/api/employees/${this.form.country_id}/states`).then(res => {
        this.states = res.data;
      }).catch(error => {
        console.log(error);
      })
    },
    getCities() {
      axios.get(`/api/employees/${this.form.state_id}/cities`).then(res => {
        this.cities = res.data;
      }).catch(error => {
        console.log(error);
      })
    },
    getDepartments() {
      axios.get(`/api/employees/departments`).then(res => {
        this.departments = res.data;
      }).catch(error => {
        console.log(error);
      })
    },
    storeEmployer() {
      // format date
      this.form.date_hired = this.format_date(this.form.date_hired);
      this.form.birthdate = this.format_date(this.form.birthdate);

      axios.post(`/api/employees`, this.form).then(res => {
        console.log(res);
      }).catch(error => {
        console.log(error);
      })

      alert("Employee saved.")
      this.$router.push("/employees")
    },
    format_date(value) {
      if(value) {
        return moment(String(value)).format('YYYY-MM-DD');
      }
    }
  },
};
</script>

<style></style>

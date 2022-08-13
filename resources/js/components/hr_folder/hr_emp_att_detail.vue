<template>
    <div v-if="user_access.hr_write=='true'">
        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <router-link to="/hr/dashboard" style="text-decoration: none;">Dashboard</router-link>
                            </li>
                            <li class="breadcrumb-item active">
                                Attendance Details
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="content-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-primary" style="padding-top:0px;padding-bottom:0px" role="alert">
                                <div class="alert-body">
                                    <ul class="nav nav-pills mb-2" style="width:90%;float:left">
                                        <li class="nav-item">
                                            <router-link to="/hr/attendance/dashboard" class="nav-link ">
                                                <i class="fa-solid fa-person"></i>
                                                <span class="fw-bold">Live Attendance</span>
                                            </router-link>
                                        </li>
                                        <li class="nav-item">
                                            <router-link to="/hr/attendance_emp" class="nav-link active">
                                                <i class="fa-solid fa-candy-cane"></i>
                                                <span class="fw-bold">Employees Attendance</span>
                                            </router-link>
                                        </li>
                                        <li class="nav-item">
                                            <router-link to="/hr/employee_overtime" class="nav-link">
                                                <i class="fa-solid fa-file-powerpoint"></i>
                                                <span class="fw-bold">Employees Overtime</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                    <div>
                                        <b-dropdown id="dropdown-right" right text="Actions" variant="primary" class="m-2" style="background-color: #0d6efd;">
                                            <b-dropdown-item :to="{ path: '/hr/attendance_grace_periods' }"> Grace Period(s) </b-dropdown-item>
                                            <b-dropdown-item :to="{ path: '/hr/attendance_rosters' }"> Shift(s) </b-dropdown-item>

                                            <b-dropdown-item>Shift Calendar</b-dropdown-item>
                                        </b-dropdown>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="app-user-view-account">
                        <div class="row">
                            <!-- User Sidebar -->
                            <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row" style="margin-bottom:20px">
                                            <div class="col-md-12">
                                                <div class="row g-1">
                                                    <div class="col-md-2 user_role">
                                                        <label class="form-label" for="UserRole">Designation</label>
                                                        <select id="UserRole" v-model="att_designation" class="form-select mb-md-0 mb-2">
                                                            <option value="All">All Designations </option>
                                                            <option v-for='designation1 in designations' :key="designation1" :value='designation1.designation_name'>{{ designation1.designation_name }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 user_plan">
                                                        <label class="form-label" for="UserPlan">Location</label>
                                                        <select v-model="att_location" id="UserPlan" class="form-select mb-md-0 mb-2">
                                                            <option value="All">All Locations </option>
                                                            <option v-for='locations1 in locations' :value='locations1.location_name'>{{ locations1.location_name }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 user_status">
                                                        <label class="form-label" for="FilterTransaction">Department</label>
                                                        <select id="FilterTransaction" v-model="att_department" class="form-select text-capitalize mb-md-0 mb-2xx">
                                                            <option value="All">All Departments </option>
                                                            <option v-for='departments1 in departments' :value='departments1.department_name'>{{ departments1.department_name }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-12 mb-2 position-relative">
                                                        <label class="form-label">Date From</label>
                                                        <input type="date" v-model="att_startingdate" class="form-control" placeholder="" required="">
                                                    </div>
                                                    <div class="col-md-2 col-12 mb-3 position-relative">
                                                        <label class="form-label">Date To</label>
                                                        <input type="date" class="form-control" v-model="att_closingdate" placeholder="" required="">
                                                    </div>
                                                    <div class="col-md-2 col-12 mb-3 position-relative">
                                                        <button @click="daily_attendance()" style="background: rgb(193, 193, 193); width: 60% !important; height: 33px !important; margin-bottom: 20px; margin-top: 25px; margin-left: 10px" class="btn btn-common">
                                                            Search
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb-2 position-relative">
                                                </div>
                                                <div class="col-md-4 col-12 mb-2 position-relative">
                                                    <label class="form-label" for="validationTooltip01">Search</label>
                                                    <input type="text" v-model="keyword1" class="form-control" placeholder="Search By Name or Employee code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive" style="overflow-x: initial !important;">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Emp Code</th>
                                                        <th>Employee Name</th>
                                                        <th>Designation</th>
                                                        <th>Department</th>
                                                        <th>Date</th>
                                                        <th>Check In</th>
                                                        <th>Check Out</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="att_report1 in att_report" >
                                                        <td>{{att_report1.EmployeeCode}}</td>
                                                        <td>{{att_report1.Name}}</td>
                                                        <td>{{att_report1.Designation}}</td>
                                                        <td>{{att_report1.Department}}</td>
                                                        <td>{{att_report1.ATTDate}}</td>
                                                        <td v-if="att_report1.CheckIN !=null">{{att_report1.CheckIN.substring(0,5)}}</td>
                                                        <td v-else></td>
                                                        <td v-if="att_report1.CheckOut !=null">{{att_report1.CheckOut.substring(0,5)}}</td>
                                                        <td v-else></td>
                                                        <td>{{att_report1.AttStatus}}</td>
                                                        <td v-if="att_report1.CheckIN !=null ||att_report1.CheckOut !=null">
                                                            <a @click="saveatt_id(att_report1.AttDataID,att_report1.EmpID,att_report1.EmployeeCode,att_report1.Name,att_report1.CheckIN.substring(0,5),att_report1.CheckOut.substring(0,5))"
                                                               data-bs-toggle="modal" data-bs-target="#employeehire1"><i class="fa-solid fa-edit"></i></a>
                                                        </td>
                                                        <td v-else>
                                                            <a @click="saveatt_id(att_report1.AttDataID,att_report1.EmpID,att_report1.EmployeeCode,att_report1.Name,att_report1.CheckIN,att_report1.CheckOut)"
                                                               data-bs-toggle="modal" data-bs-target="#employeehire1"><i class="fa-solid fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- END: Content-->
        <!-- Modal 1-->
        <div class="modal fade" id="employeehire1" aria-labelledby="employeehire1Label" tabindex="-1" style="display: none" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalToggleLabel">Update Employee Attendance</h5>

                        <button type="button" class="btn-close" @click="cleargrace_id()" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <div class="modal-body">

                        <!-- form -->
                        <div id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="modalAddCardName">Employee Code</label>
                                    <input readonly type="text" v-model="emp_code" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="modalAddCardName">Employee Name</label>
                                    <input type="text" readonly v-model="emp_name" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="modalAddCardName">Check In</label>
                                    <input type="time" v-model="check_in" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="modalAddCardName">Check Out</label>
                                    <input type="time" v-model="check_out" class="form-control">
                                </div>

                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" @click="update_att()" data-bs-dismiss="modal" aria-label="Close">
                            Save
                        </button>
                        <button type="button" class="btn btn-primary" @click="cleargrace_id()" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {

        data: function () {
            return {
              user_access:{},
                att_id: '',
                emp_id: '',
                emp_code: '',
                emp_name: '',
                check_in: '08:00',
                check_out: '18:00',
                locations: {},
                designations: {},
                departments: {},

                att_department: 'All',
                att_startingdate: '',
                att_closingdate: '',
                att_designation: 'All',
                att_location: 'All',
                keyword1: '',

                att_report: {},
                adsdata: {

                },

            }
        },
        watch: {
            keyword1(after, before) {
                this.getResults();
            }
        },
        methods: {
            getResults() {

                axios.get('./search_att', { params: { keyword1: this.keyword1 } })
                    .then(response => this.att_report = response.data)
                    .catch(error => console.log(error));
            },
            update_att() {
                axios.post('./update_ind_att', {
                    att_id: this.att_id,
                    check_in: this.check_in,
                    check_out: this.check_out,
                })
                    .then(data => {

                        this.$toastr.s("Updated  Employee Attendance Successfully", "Congratulations");
                        console.log(data.data);
                        this.daily_attendance();

                    })
            },


            saveatt_id(attid, empid, empcode, employeename, checkin, checkout) {
                this.att_id = attid;
                this.emp_id = empid;
                this.emp_code = empcode;
                this.emp_name = employeename;
                this.check_in = checkin;
                this.check_out = checkout;
            },
            cleargrace_id() {
                this.att_id = '';
                this.emp_id = '';
                this.emp_code = '';
                this.emp_name = '';
                this.check_in = '08:00';
                this.check_out = '18:00';
            },
            getdailyattendancereport() {
                axios.get('./getattendance_report9/' + this.att_department + '/' + this.att_location + '/' + this.att_designation + '/' + this.att_startingdate + '/' + this.att_closingdate)
                    .then(response => {
                        this.att_report = response.data;

                    })
                    .catch(error => { });
            },
            daily_attendance() {

                if (this.att_startingdate == '' && this.att_closingdate == '') {
                    this.$toastr.e("Please Select From and End Date(s)", "Error!");
                }
                else {

                    this.getdailyattendancereport();
                }


            },



        },

        mounted() {

            axios.get('department_detail2')
                .then(data => this.departments = data.data)
                .catch(error => { });
            axios.get('overall_location')
                .then(response => this.locations = response.data)
                .catch(error => { });
            axios.get('overall_designation')
                .then(response => {
                    this.designations = response.data;

                })
            axios.get('find_emp_id')
                .then(data => this.find_emp = data.data)
                .catch(error => { });
            axios.get('overall_leaves')
                .then(response => this.leaves = response.data)
                .catch(error => { });
 axios.get('./fetch_user_hr_roles')
                .then(response => this.user_access = response.data)

        }
    }

</script>

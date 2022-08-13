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
                            <li class="breadcrumb-item">
                                <router-link to="/hr/leaves_dashbaord" style="text-decoration: none;">Leaves Management(s)</router-link>
                            </li>
                            <li class="breadcrumb-item active">
                                All leave applications
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <section class="app-user-view-account">
                <div class="row">
                    <!-- User Sidebar -->
                    <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-header">
                                        <h2 style="font-size:28px" class="card-title">Leave(s) Detail</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Search &amp; Filter</h4>
                                <div class="row">
                                    <div class="col-md-2 user_role">
                                        <label class="form-label" for="UserRole">Leave Type<span style="color:red">*</span></label>
                                        <select id="UserRole" v-model="leave" class="form-select mb-md-0 mb-2">
                                            <option value="All">All Types</option>
                                            <option value="Annual">Annual</option>
                                            <option value="Casual">Casual</option>
                                            <option value="Sick">Sick</option>
                                            <option value="CPL">CPL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 user_role">
                                        <label class="form-label" for="UserRole">Designation</label>
                                        <select id="UserRole" v-model="designation" class="form-select mb-md-0 mb-2">
                                            <option value="All">All Designations </option>
                                            <option v-for='designation1 in designations' :value='designation1.designation_name'>{{ designation1.designation_name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 user_plan">
                                        <label class="form-label" for="UserPlan">Location</label>
                                        <select v-model="location" id="UserPlan" class="form-select mb-md-0 mb-2">
                                            <option value="All">All Locations </option>
                                            <option v-for='locations1 in locations' :value='locations1.location_name'>{{ locations1.location_name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 user_status">
                                        <label class="form-label" for="FilterTransaction">Department</label>
                                        <select id="FilterTransaction" v-model="department" class="form-select text-capitalize mb-md-0 mb-2xx">
                                            <option value="All">All Departments </option>
                                            <option v-for='departments1 in departments' :value='departments1.department_name'>{{ departments1.department_name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 user_status">
                                        <button @click="getbyfilter()" style="background:#c1c1c1;width:100%;height: 35px !important;margin-top: 25px;margin-bottom:20px;" class="btn btn-common">Search</button>
                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive" style="overflow-x: initial !important;">
                                    <table class="table" style="border: 2px solid lightgrey">
                                        <thead style="">
                                            <tr style="text-align: center;">
                                                <th style="max-width:40px; border-right:1px solid lightgrey;">Emp Code</th>
                                                <th style="border-right:1px solid lightgrey">Emp Name</th>
                                                <th style="border-right:1px solid lightgrey">Department</th>
                                                <th style="border-right:1px solid lightgrey">Leave Type</th>
                                                <th style="border-right:1px solid lightgrey">Status</th>
                                                <th style="border-right:1px solid lightgrey; width:6%;">Number of days</th>
                                                <th style="border-right:1px solid lightgrey">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="leaves2 in leaves" style="vertical-align: middle;">
                                                <td style="max-width: 40px; border-right: 1px solid lightgrey; text-align: center;">{{leaves2.EmployeeCode}}</td>
                                                <td style="border-right:1px solid lightgrey">
                                                    <div @click="fetch_leave_upSts(leaves2.LeaveRQID)" class="d-flex justify-content-left align-items-center" style="cursor:pointer; width:50%;" data-bs-toggle="modal" data-bs-target="#view_leave">
                                                        <div class="avatar-wrapper">
                                                            <div class="avatar  me-1">
                                                                <img v-bind:src="`public/images/profile_images/${leaves2.Photo}`" alt="Avatar" height="32" width="32">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column"><a class="user_name text-truncate text-body"><span class="fw-bolder"> </span>{{leaves2.Name}}</a><small class="emp_post text-muted">{{leaves2.Designation}}</small></div>
                                                    </div>
                                                </td>
                                                <td style="border-right: 1px solid lightgrey; text-align: center;">
                                                    <div class="d-flex flex-column">
                                                        <a class="user_name text-truncate text-body"><span class="fw-bolder"></span>{{leaves2.Department}}</a>



                                                        <small class="emp_post text-muted" v-if="leaves2.PostingCity!=''">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                                                            </svg>
                                                            {{leaves2.PostingCity}}
                                                        </small>
                                                    </div>
                                                </td>
                                                <td style="border-right: 1px solid lightgrey; text-align: center;">{{leaves2.Leavetype}}</td>
                                                <td style="border-right: 1px solid lightgrey; text-align: center;">
                                                    <span v-if="user_access.hr_overall=='true'">
                                                        <span @click="fetch_leave_upSts(leaves2.LeaveRQID)" v-if="leaves2.PendingLeaveStatus=='P'" class="badge bg-gradient-warning" data-bs-toggle="modal" data-bs-target="#updt_lv_sts" style="cursor: pointer;">Pending</span>




                                                        <span v-else-if="leaves2.PendingLeaveStatus=='R'" class="badge bg-danger">Rejected</span>
                                                        <span v-else-if="leaves2.PendingLeaveStatus=='A'" class="badge bg-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star me-25"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                            <span>Approved</span>
                                                        </span>
                                                        <span v-else-if="leaves2.PendingLeaveStatus=='OL'" class="badge bg-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star me-25"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                            <span>Limit exceded</span>
                                                        </span>
                                                    </span>
                                                    <span v-else>
                                                        <span v-if="leaves2.PendingLeaveStatus=='P'" class="badge bg-gradient-warning" style="cursor: pointer;">Pending</span>




                                                        <span v-else-if="leaves2.PendingLeaveStatus=='R'" class="badge bg-danger">Rejected</span>
                                                        <span v-else-if="leaves2.PendingLeaveStatus=='A'" class="badge bg-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star me-25"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                            <span>Approved</span>
                                                        </span>
                                                        <span v-else-if="leaves2.PendingLeaveStatus=='OL'" class="badge bg-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star me-25"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                            <span>Limit exceded</span>
                                                        </span>
                                                    </span>
                                                </td>
                                                <td style="text-align:center; border-right:1px solid lightgrey">{{leaves2.NoOfDays}}</td>
                                                <td style="text-align:center;">
                                                    <span>{{leaves2.StartDate}}</span>
                                                    <span v-if="leaves2.EndDate!=null"><br />to</span><br />
                                                    <span v-if="leaves2.EndDate!=null">{{leaves2.EndDate}}</span>
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

        <!-- View leave Modal -->
        <div class="modal fade" id="view_leave" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="mb-2">
                            <div class="col-md-12">
                                <table style="width:100%;">
                                    <thead style="float: left; width: 100%;">
                                        <h2 style="text-align:center;">{{lv_type}} leave application</h2>
                                        <tr>
                                            <th style="width:20%">Application ID: </th>
                                            <td style="width:39%"> {{lv_app_id}}</td>
                                            <th>Employee Name: </th>
                                            <td> {{lv_emp_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Employee ID: </th>
                                            <td> {{lv_emp_id}}</td>
                                            <th>Father's Name: </th>
                                            <td> {{lv_emp_Fname}}</td>
                                        </tr>
                                        <tr>
                                            <th>Department: </th>
                                            <td> {{lv_dept}}</td>
                                            <th>Designation: </th>
                                            <td> {{lv_designation}}</td>
                                        </tr>
                                        <tr>
                                            <th>Number of leaves: </th>
                                            <td> {{lv_number}}</td>
                                            <th>Leave type: </th>
                                            <td> {{lv_type}}</td>
                                        </tr>
                                        <tr>
                                            <th v-if="this.lv_number!='1'">Start date: </th>
                                            <th v-else>Date: </th>
                                            <td> {{lv_from}}</td>
                                            <th v-if="this.lv_number!='1'">To date: </th>
                                            <td v-if="this.lv_number!='1'"> {{lv_to}}</td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label class="form-label"><strong></strong></label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-2">
                                            <div class="text-center" style="text-align:center; margin-top:30px;">
                                                <button type="submit" class="btn btn-outline-primary waves-effect" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ View leave Modal -->
        <!-- Update leave ststus Modal -->
        <div class="modal fade" id="updt_lv_sts" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="mb-2">
                            <div class="col-md-12">
                                <table style="width:100%;">
                                    <thead style="float: left; width: 100%;">
                                        <h2 style="text-align:center;">{{lv_type}} leave application</h2>
                                        <tr>
                                            <th style="width:20%">Application ID: </th>
                                            <td style="width:39%"> {{lv_app_id}}</td>
                                            <th>Employee Name: </th>
                                            <td> {{lv_emp_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Employee ID: </th>
                                            <td> {{lv_emp_id}}</td>
                                            <th>Father's Name: </th>
                                            <td> {{lv_emp_Fname}}</td>
                                        </tr>
                                        <tr>
                                            <th>Department: </th>
                                            <td> {{lv_dept}}</td>
                                            <th>Designation: </th>
                                            <td> {{lv_designation}}</td>
                                        </tr>
                                        <tr>
                                            <th>Number of leaves: </th>
                                            <td> {{lv_number}}</td>
                                            <th>Leave type: </th>
                                            <td> {{lv_type}}</td>
                                        </tr>
                                        <tr>
                                            <th v-if="this.lv_number!='1'">Start date: </th>
                                            <th v-else>Date: </th>
                                            <td> {{lv_from}}</td>
                                            <th v-if="this.lv_number!='1'">To date: </th>
                                            <td v-if="this.lv_number!='1'"> {{lv_to}}</td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label class="form-label"><strong></strong></label>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Change status</strong>
                                        <select class="form-select mb-md-0 mb-2" v-model="lv_status">
                                            <option value="" selected>Select</option>
                                            <option value="A">Approved</option>
                                            <option value="P">Pending</option>
                                            <option value="R">Rejected</option>
                                        </select>
                                        <span style="color: #DB4437; font-size: 11px;" v-if="this.lv_status==''">{{lv_status_error}}</span>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="mb-2">

                                            <div class="text-center" style="text-align:center; margin-top:30px;">
                                                <button :disabled="disabled" @click="delay()" type="button" class="btn btn-primary waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Update</button>
                                                <button type="submit" class="btn btn-outline-primary waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancle</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--/ Update leave status Modal -->
    </div>

</template>
<script>
    export default {
        data() {
            return {
             user_access:{},
                department: 'All',
                location: 'All',
                designation: 'All',
                designations: {},
                locations: {},
                departments: {},
                leaves: {},
                leave: 'All',

                days: 'One Day',
                emp_leave: '',
                emp_date_from: '',
                emp_date_to: '',
                emp_reason: '',
                emp_emp_id: '',
                find_emp: {},

                lv_status: '',
                lv_status_error: '',
                u_lv_id: '',

                lv_app_id: '',
                lv_app_date: '',
                lv_emp_id: '',
                lv_emp_name: '',
                lv_emp_Fname:'',
                lv_dept: '',
                lv_designation: '',
                lv_type: '',
                lv_number: '',
                lv_from: '',
                lv_to: '',
                us_lv_type: '',

                disabled: false,
                timeout: null,
            }
        },
        methods: {
            delay() {
                this.disabled = true
                this.timeout = setTimeout(() => {
                    this.disabled = false
                }, 5000)
                this.update_leave_status()
            },
            getbyfilter() {
                    axios.get('./filter_leaves_requisitions/' + this.leave + '/' + this.department + '/' + this.location + '/' + this.designation)
                        .then(data => this.leaves = data.data)
                        .catch(error => { });
            },
            fetch_leave_upSts(id1) {
                this.u_lv_id = id1;
                axios.get('fetch_leave_upSts/' + this.u_lv_id)
                    .then(responce => {
                        this.lv_app_date = "21-06-22";
                        this.lv_app_id = responce.data[0].LeaveRQID;
                        this.lv_emp_id = responce.data[0].EmployeeID;
                        this.lv_emp_name = responce.data[0].Name;
                        this.lv_emp_Fname = responce.data[0].FatherHusband;
                        this.lv_dept = responce.data[0].Department;
                        this.lv_designation = responce.data[0].Designation;
                        this.lv_type = responce.data[0].Leavetype;
                        this.lv_number = responce.data[0].NoOfDays;
                        this.lv_from = responce.data[0].StartDate;
                        this.lv_to = responce.data[0].EndDate
                    })
            },

            update_leave_status() {

                if (this.lv_status=='') {
                    this.lv_status_error = "Select status";
                    this.$toastr.e("Status not updated", "Error!");
                }
                else {
                    this.lv_status_error = "";
                    axios.post('./update_leave_sts', {
                        lv_app_id: this.lv_app_id,
                        lv_status: this.lv_status,
                        us_lv_type: this.lv_type,
                        us_emp_id: this.lv_emp_id,
                        lv_number: this.lv_number,
                        lv_from: this.lv_from,
                        lv_to: this.lv_to,

                    })
                        .then(data => {
                            if (data.data == "Status updated!") {
                                this.$toastr.s("Leave status updated successfully!", "Congratulations");
                                this.lv_status = "";
                                axios.get('all_leaves')
                                    .then(response => this.leaves = response.data)
                                    .catch(error => { });
                            }
                            else if (data.data == "Previous status updated!"){
                                this.$toastr.s("Previous leave status updated successfully!", "Congratulations");
                                axios.get('all_leaves')
                                    .then(response => this.leaves = response.data)
                                    .catch(error => { });
                            }
                        })
                }

            },
        },

        mounted() {

            axios.get('department_detail2')
                .then(data => this.departments = data.data)
                .catch(error => { });
            axios.get('overall_designation')
                .then(response => this.designations = response.data)
                .catch(error => { });
            axios.get('overall_location')
                .then(response => this.locations = response.data)
                .catch(error => { });
            axios.get('all_leaves')
                .then(response => this.leaves = response.data)
                .catch(error => { });
            axios.get('find_emp_id')
                .then(data => this.find_emp = data.data)
                .catch(error => { });
                axios.get('./fetch_user_hr_roles')
                .then(response => this.user_access = response.data)
        }
    }

</script>

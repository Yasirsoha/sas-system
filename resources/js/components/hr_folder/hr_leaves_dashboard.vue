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
                                Leaves Management
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
                                        <h2 style="font-size:28px" class="card-title">Leaves Detail</h2>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="demo-inline-spacing">
                                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#addNewCard" class="btn btn-outline-primary waves-effect">Apply Leave</a>
                                        <a href="#" type="button"  data-bs-toggle="modal" data-bs-target="#emp_leave_model" class="btn btn-outline-primary waves-effect">Update Employees Leaves</a>
                                        <router-link to="/hr/employee_all_leaves" type="button" class="btn btn-outline-primary waves-effect">View requests</router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="card-title">Search &amp; Filter</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <input autocomplete="off" type="text" @change="getbyId()" id="emp_name_code" v-model="emp_name_code" name="emp_name_code" class="form-control" placeholder="Search By Name or Employee code">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 user_role">
                                        <label class="form-label" for="UserRole">Leave Type<span style="color:red">*</span></label>
                                        <select id="UserRole" v-model="leave" class="form-select mb-md-0 mb-2">
                                            <option value="All">All Types</option>
                                            <option v-for='leaves1 in leaves' :value='leaves1.LeaveType'>{{ leaves1.LeaveType}}</option>
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
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th style="max-width:40px;border-right:1px solid lightgrey">Emp Code</th>
                                                <th style="border-right:1px solid lightgrey">Emp Name</th>
                                                <th style="border-right:1px solid lightgrey">Department</th>
                                                <th style="border-right:1px solid lightgrey">Leave Type</th>
                                                <th style="border-right:1px solid lightgrey">Total Leaves</th>
                                                <th style="border-right:1px solid lightgrey">Remaining Leaves</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="adsdata1 in adsdata">
                                                <td></td>
                                                <td style="max-width:40px;border-right:1px solid lightgrey">{{adsdata1.EmployeeCode}}</td>
                                                <td style="border-right:1px solid lightgrey">
                                                    <div class="d-flex justify-content-left align-items-center">
                                                        <div class="avatar-wrapper">
                                                            <div class="avatar  me-1">
                                                                <img v-bind:src="`public/images/profile_images/${adsdata1.Photo}`" alt="Avatar" height="32" width="32">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column"><a class="user_name text-truncate text-body"><span class="fw-bolder"> </span>{{adsdata1.Name}}</a><small class="emp_post text-muted">{{adsdata1.Designation}}</small></div>
                                                    </div>
                                                </td>
                                                <td style="border-right:1px solid lightgrey">
                                                    <div class="d-flex flex-column"><a class="user_name text-truncate text-body"><span class="fw-bolder"> </span>{{adsdata1.Department}}</a><small class="emp_post text-muted">{{adsdata1.PostingCity}}</small></div>
                                                </td>
                                                <td style="border-right:1px solid lightgrey">{{adsdata1.LeaveType}}</td>
                                                <td style="text-align:center;border-right:1px solid lightgrey">{{adsdata1.TotalLeave}}</td>
                                                <td style="text-align:center;border-right:1px solid lightgrey">{{adsdata1.RemainingLeave}}</td>
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

        <!-- Add emp leave model-->
        <div class="modal fade" id="emp_leave_model" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <h3 class="text-center mb-1" id="addNewCardTitle">Assign leave(s) to Employee</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 mx-50 pb-5">
                        <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                            <div class="col-12">
                                <label class="form-label" for="modalAddCardName">Employee Id</label>
                                <span style="color: #DB4437; font-size: 11px;">*</span>
                                <select v-model="lv_emp_id" class="form-control">
                                    <option value="">Select Employee</option>
                                    <option v-for='find_emp1 in find_emp' :value='find_emp1.EmployeeID'>{{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}</option>
                                </select>
                                <span style="color: #DB4437; font-size: 11px;" v-if="lv_emp_id==''">{{e_lv_emp_id}}</span>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="modalAddCardName">Leave Type</label>
                                <span style="color: #DB4437; font-size: 11px;">*</span>
                                <select v-model="lv_type" class="form-control">
                                    <option value="">Select Leave Type</option>
                                    <option v-for='l_types1 in l_types.data' :value='l_types1.LeaveType'>{{ l_types1.LeaveType }}</option>
                                </select>
                                <span style="color: #DB4437; font-size: 11px;" v-if="lv_type==''">{{e_lv_type}}</span>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="modalAddCardName">Number of leaves</label>
                                <input v-model="lv_nmbr" type="number" placeholder="Number of leaves" id="modalAddCardName" class="form-control" />
                                <span style="color: #DB4437; font-size: 11px;" v-if="lv_nmbr==''">{{e_lv_nmbr}}</span>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" :disabled="disabled1" @click="delay1()" class="btn btn-primary me-1 mt-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Add emp leave model-->
        <!-- Model apply leave-->
        <div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <h3 class="text-center mb-1" id="addNewCardTitle">Apply For Leave</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 mx-50 pb-5">
                        <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                            <div class="col-12">
                                <table class="table" v-if="this.isLvEmpty != 'Empty'">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Granted</th>
                                            <th>Used</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="leavesblnc1 in leavesblnc">
                                            <td>{{leavesblnc1.LeaveType}}</td>
                                            <td>{{leavesblnc1.TotalLeave}}</td>
                                            <td>{{leavesblnc1.TotalLeave - leavesblnc1.RemainingLeave}}</td>
                                            <td>{{leavesblnc1.RemainingLeave}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalAddCardName">Employee Id</label>
                                <select @click="fetch_emp_leave()" v-model="emp_emp_id" class="form-control">
                                    <option value="">Select Employee</option>
                                    <option v-for='find_emp1 in find_emp' :value='find_emp1.EmployeeID'>{{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}</option>
                                </select>
                                <span style="color: #DB4437; font-size: 11px;" v-if="this.emp_emp_id==''">{{emp_emp_id_error}}</span>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalAddCardNumber">Leave Type</label>
                                <select v-model="emp_leave" class="form-control">
                                    <option value="">Select Type</option>
                                    <option v-for='leaves1 in leaves' :value='leaves1.LeaveType'>{{ leaves1.LeaveType}}</option>
                                    <option value="UnPaid">UnPaid</option>
                                </select>
                                <span style="color: #DB4437; font-size: 11px;" v-if="this.emp_leave==''">{{emp_leave_error}}</span>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="modalAddCardName">Date From</label>
                                <input v-model="emp_date_from" type="date" id="modalAddCardName" class="form-control" />
                                <span style="color: #DB4437; font-size: 11px;" v-if="this.emp_date_from==''">{{emp_date_from_error}}</span>
                            </div>
                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="basicSelect">Select Days</label>
                                <div class="row demo-inline-spacing" style="padding-left: 5%;">
                                    <div class="col-md-5 form-check form-check-inline" style="margin-top:0px">
                                        <input class="form-check-input" type="radio" v-model="days" name="inlineRadioOptions" id="inlineRadio1" value="One Day" checked="">
                                        <label class="form-check-label" for="inlineRadio1">One Day</label>
                                    </div>
                                    <div class=" col-md-5 form-check form-check-inline" style="margin-top:0px">
                                        <input class="form-check-input" type="radio" v-model="days" name="inlineRadioOptions" id="inlineRadio2" value="Multiple Days">
                                        <label class="form-check-label" for="inlineRadio2">Multiple Days</label>
                                    </div>
                                </div>
                            </div>
                            <div v-if="this.days=='Multiple Days'" class="col-md-12">
                                <label class="form-label" for="modalAddCardName">Date To</label>
                                <input v-model="emp_date_to" type="date" id="modalAddCardName" class="form-control" />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="modalAddCardName">Reason</label>
                                <input v-model="emp_reason" type="text" id="modalAddCardName" class="form-control" />
                                <span style="color: #DB4437; font-size: 11px;" v-if="this.emp_reason==''">{{emp_reason_error}}</span>
                            </div>
                            <div class="col-12 text-center">
                                <button :disabled="disabled" @click="delay()" type="submit" class="btn btn-primary me-1 mt-1" data-bs-dismiss="modal" aria-label="Close">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Model apply leave-->
    </div>

</template>
<script>
    export default {
        data() {
            return {

                lv_type: '',
                lv_emp_id: '',
                lv_nmbr: '',
                e_lv_type: '',
                e_lv_emp_id: '',
                e_lv_nmbr: '',

                user_access: {},
                department: 'All',
                location: 'All',
                designation: 'All',
                designations: {},
                locations: {},
                departments: {},
                adsdata: {},
                leaves: {},
                leavesblnc: {},
                isLvEmpty: 'Empty',
                leave: 'All',
                days: 'One Day',
                emp_leave: '',
                emp_date_from: '',
                emp_date_to: '',
                emp_reason: '',
                emp_emp_id: '',
                emp_name_code: '',
                find_emp: {},
                l_types: {},

                emp_emp_id_error: '',
                emp_leave_error: '',
                emp_date_from_error: '',
                emp_reason_error: '',

                disabled: false,
                timeout: null,

                disabled1: false,
                timeout1: null,
            }
        },

        watch: {
            emp_name_code(after, before) {
                this.getbyId();
            }
        },
        methods: {
            delay() {
                this.disabled = true
                this.timeout = setTimeout(() => {
                    this.disabled = false
                }, 5000)
                this.submit_leave()
            },
            delay1() {
                this.disabled1 = true
                this.timeout1 = setTimeout(() => {
                    this.disabled1 = false
                }, 5000)
                this.submit_emp_leave()
            },

            submit_emp_leave() {
                if (this.lv_emp_id == '' || this.lv_type == '' || this.lv_nmbr == '') {
                    if (this.lv_emp_id == '') {
                        this.e_lv_emp_id = "Select employee";
                    }
                    else {
                        this.e_lv_emp_id = "";
                    }
                    if (this.lv_type == '') {
                        this.e_lv_type = "Select leave type";
                    }
                    else {
                        this.e_lv_type = "";
                    }
                    if (this.lv_nmbr == '') {
                        this.e_lv_nmbr = "Enter number of leave";
                    }
                    else {
                        this.e_lv_nmbr = "";
                    }
                    this.$toastr.e("Please fill required fields!", "Caution!");
                }
                else {
                    axios.post('submit_emp_leaves', {
                        lv_emp_id: this.lv_emp_id,
                        lv_type: this.lv_type,
                        lv_nmbr: this.lv_nmbr,
                    })
                        .then(data => {
                            if (data.data == 'Employee leave added') {
                                this.$toastr.s("Employee leave added!", "Success");
                                this.lv_emp_id = "";
                                this.lv_type = "";
                                this.lv_nmbr = "";

                                this.getbyfilter();
                            }
                            else if (data.data == 'Employee leave updated') {
                                this.$toastr.s("Employee leaves updates!", "Success");
                                this.lv_emp_id = "";
                                this.lv_type = "";
                                this.lv_nmbr = "";

                                this.getbyfilter();
                            }
                        })
                }
            },

            fetch_emp_leave() {
                axios.get('selected_emp_leaves_blnc/' + this.emp_emp_id)
                    .then(data => {
                        this.leavesblnc = data.data;
                        if (this.leavesblnc == '') {
                            this.isLvEmpty = "Empty";
                        }
                        else {
                            this.isLvEmpty = "Not empty";
                        }
                    })
                    .catch(error => { });
            },
            submit_leave() {
                if (this.emp_emp_id == '' || this.emp_emp_id == '' || this.emp_date_from == '' || this.emp_reason == '') {
                    if (this.emp_emp_id == '') {
                        this.emp_emp_id_error = "Select employee";
                    }
                    else {
                        this.emp_emp_id_error = "";
                    }
                    if (this.emp_leave == '') {
                        this.emp_leave_error = "Select leave type";
                    }
                    else {
                        this.emp_leave_error = "";
                    }
                    if (this.emp_date_from == '') {
                        this.emp_date_from_error = "Select date";
                    }
                    else {
                        this.emp_date_from_error = "";
                    }
                    if (this.emp_reason == '') {
                        this.emp_reason_error = "Type reson";
                    }
                    else {
                        this.emp_reason_error = "";
                    }

                    this.$toastr.e("Leave not applied", "Important Fields Missing!")

                }
                else {
                    axios.post('submit_leave', {
                        emp_emp_id: this.emp_emp_id,
                        days: this.days,
                        emp_date_from: this.emp_date_from,
                        emp_date_to: this.emp_date_to,
                        emp_reason: this.emp_reason,
                        emp_leave: this.emp_leave,
                    })
                        .then(data => {
                            if (data.data == 'submitted') {
                                this.$toastr.s("Submitted Leave Successfully!", "Congratulations");
                            }

                        })
                }
            },

            getbyId() {
                axios.get('./filter_leaves_byId', { params: { emp_name_code: this.emp_name_code } })
                    .then(data => this.adsdata = data.data)
                    .catch(error => { });
            },
            getbyfilter() {
                axios.get('./filter_leaves/' + this.leave + '/' + this.department + '/' + this.location + '/' + this.designation)
                    .then(data => this.adsdata = data.data)
                    .catch(error => { });
            },

        },

        mounted() {
            this.getbyfilter();
            axios.get('view_leave_type/')
                .then(response => this.l_types = response.data)
                .catch(error => { });

            axios.get('department_detail2')
                .then(data => this.departments = data.data)
                .catch(error => { });
            axios.get('overall_designation')
                .then(response => this.designations = response.data)
                .catch(error => { });
            axios.get('overall_location')
                .then(response => this.locations = response.data)
                .catch(error => { });
            axios.get('overall_leaves')
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

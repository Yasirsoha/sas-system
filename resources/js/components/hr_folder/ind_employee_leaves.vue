<template>
    <div>
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
                                <router-link to="/hr/employees_detail" style="text-decoration: none;">Employees Detail</router-link>
                            </li>
                            <li class="breadcrumb-item active">
                                Employee Leaves
                            </li>
                        </ol>
                        <b-progress :value="percent.address+percent.city+percent.cnic+percent.company_email+percent.department+percent.designation+percent.dob+percent.edu_status+percent.email+percent.emp_code+percent.exp_status+percent.father+percent.gender+percent.job_des+percent.marital+percent.mobile+percent.photo+percent.reporting" variant="success"
                                    :label="`${(((percent.address+percent.city+percent.cnic+percent.company_email+percent.department+percent.designation+percent.dob+percent.edu_status+percent.email+percent.emp_code+percent.exp_status+percent.father+percent.gender+percent.job_des+percent.marital+percent.mobile+percent.photo+percent.reporting) / max) * 100).toFixed(0)}%`" :striped="striped" animated class="mb-3">
                        </b-progress>
                    </div>
                </div>
                <div class="content-body">
                    <section class="app-user-view-account">
                        <div class="row">
                            <div v-for='emp_detail1 in emp_detail' class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                                <!-- User Card -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="user-avatar-section">
                                            <div class="d-flex align-items-center flex-column">
                                                <img v-if="emp_detail1.Photo==''" class="img-fluid rounded mt-3 mb-2" src="public/images/profile_images/pro.png" height="110" width="110" alt="User avatar" />
                                                <img v-else class="img-fluid rounded mt-3 mb-2" v-bind:src="`public/images/profile_images/${emp_detail1.Photo}`" height="110" width="110" alt="User avatar" />
                                                <div class="user-info text-center">
                                                    <h4>{{emp_detail1.Name}}</h4>
                                                    <span class="badge bg-light-secondary">{{emp_detail1.Designation}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-around my-2 pt-75">
                                            <div class="d-flex align-items-start me-2">
                                                <span class="badge bg-light-primary p-75 rounded">

                                                    <i class="font-medium-2 fa-solid fa-check" style="margin-right: 5px"></i>
                                                </span>
                                                <div class="ms-75">
                                                    <h4 class="mb-0">{{com_year}}</h4>
                                                    <small>Years Completed</small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start">
                                                <span class="badge bg-light-primary p-75 rounded">

                                                    <i class="fa-solid fa-bars-progress font-medium-2" style="margin-right: 5px"></i>
                                                </span>
                                                <div class="ms-75">
                                                    <h4 class="mb-0">{{percent.address+percent.city+percent.cnic+percent.company_email+percent.department+percent.designation+percent.dob+percent.edu_status+percent.email+percent.emp_code+percent.exp_status+percent.father+percent.gender+percent.job_des+percent.marital+percent.mobile+percent.photo+percent.reporting}}%</h4>
                                                    <small>Profile</small>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                                        <div class="info-container">
                                            <ul class="list-unstyled">
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Father Name:</span>
                                                    <span>{{emp_detail1.FatherHusband}}</span>
                                                </li>
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Email:</span>
                                                    <span>{{emp_detail1.Email}}</span>
                                                </li>
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Date Of Birth:</span>
                                                    <span>{{emp_detail1.DOB}}</span>
                                                </li>
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Gender:</span>
                                                    <span>{{emp_detail1.Gender}}</span>
                                                </li>
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Religion:</span>
                                                    <span>{{emp_detail1.Religion}}</span>
                                                </li>
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Contact:</span>
                                                    <span>{{emp_detail1.Mobile}}</span>
                                                </li>

                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">City:</span>
                                                    <span>{{emp_detail1.City}}</span>
                                                </li>
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Country:</span>
                                                    <span>Pakistan</span>
                                                </li>
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Status:</span>
                                                    <span class="badge bg-light-success">{{emp_detail1.Status}}</span>
                                                </li>
                                            </ul>
                                            <div class="d-flex justify-content-center pt-2">
                                                <button v-if="emp_detail1.Status!='Registered'" @click="registered(emp_detail1.EmployeeID)" class="btn btn-outline-primary suspend-user me-1">Registered</button>
                                                <button v-if="emp_detail1.Status!='Resigned'" @click="resigned(emp_detail1.EmployeeID)" class="btn btn-outline-primary suspend-user me-1">Resigned</button>
                                                <button v-else class="btn btn-outline-primary suspend-user me-1">Resigned</button>
                                                <button v-if="emp_detail1.Status!='Suspended'" @click="suspend(emp_detail1.EmployeeID)" class="btn btn-outline-danger suspend-user">Suspend</button>
                                                <button v-else class="btn btn-outline-danger suspend-user">Suspend</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /User Card -->
                                <!-- Plan Card -->
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <span class="badge bg-light-primary">Salary</span>
                                            <div class="d-flex justify-content-center">
                                                <sup class="h5 pricing-currency text-primary mt-1 mb-0">Rs.</sup>
                                                <span class="fw-bolder display-5 mb-0 text-primary" style="font-size:18px">{{emp_detail1.Salary}}</span>
                                                <sub class="pricing-duration font-small-4 ms-25 mt-auto mb-2">/month</sub>
                                            </div>
                                        </div>
                                        <div style="font-size:18px;margin-top:20px">
                                            <span class="fw-bolder display-5 mb-0 text-primary" style="font-size:18px">Job Description</span>
                                        </div>
                                        <label v-html='emp_detail1.JobDescription'></label>
                                    </div>
                                </div>
                                <!-- /Plan Card -->
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

                                <ul class="nav nav-pills mb-2" style="padding-left:20px !important">
                                    <li class="nav-item">
                                        <router-link :to="{ name: 'employee_detail', params: { id: this.id }}" class="nav-link">
                                            <i class="fa-solid fa-person"></i>
                                            <span class="fw-bold">Personal</span>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link :to="{ name: 'employee_leaves', params: { id: this.id }}" class="nav-link active">
                                            <i class="fa-solid fa-candy-cane"></i>
                                            <span class="fw-bold">Leaves</span>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link :to="{ name: 'employee_attendance', params: { id: this.id }}" class="nav-link">
                                            <i class="fa-solid fa-file-powerpoint"></i>
                                            <span class="fw-bold">Attendance</span>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/hr/employee_financial" class="nav-link">
                                            <i class="fa-solid fa-receipt"></i><span class="fw-bold">Financial History</span>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link class="nav-link" to="/hr/employee_perfomance">
                                            <i class="fa-solid fa-link"></i><span class="fw-bold">Performance</span>
                                        </router-link>
                                    </li>
                                </ul>
                                <!--/ User Pills -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Leaves Balances</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table text-nowrap text-center">
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
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Leaves History</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table text-nowrap text-center">
                                            <thead>
                                                <tr class="central-text-align">
                                                    <th>Leave Type</th>
                                                    <th>No. Of Days</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Reason</th>
                                                    <th>HR Approval</th>
                                                    <th>Manager Approval</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="leaves1 in leaves">
                                                    <td>{{leaves1.Leavetype}}</td>
                                                    <td>{{leaves1.NoOfDays}}</td>
                                                    <td>{{leaves1.StartDate}}</td>
                                                    <td>{{leaves1.EndDate}}</td>
                                                    <td>{{leaves1.Reason}}</td>
                                                    <td>{{leaves1.HRApproval}}</td>
                                                    <td>{{leaves1.ManagerApproval}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Office Time Table</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr class="central-text-align">
                                                    <th><b>Week Day</b></th>
                                                    <th><b>Check In Time</b></th>
                                                    <th><b>Check Out Time</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="central-text-align">
                                                    <td>Sunday</td>
                                                    <td v-if="this.u_sun_in!=''">{{u_sun_in}}</td>
                                                    <td v-if="this.u_sun_out!=''">{{u_sun_out}}</td>
                                                    <td v-else colspan="2" class="central-text-align">Weekend</td>
                                                </tr>
                                                <tr class="central-text-align ">
                                                    <td>Monday</td>
                                                    <td v-if="this.u_mon_in!=''">{{u_mon_in}}</td>
                                                    <td v-if="this.u_mon_out!=''">{{u_mon_out}}</td>
                                                    <td v-else colspan="2" class="central-text-align">Weekend</td>
                                                </tr>
                                                <tr class="central-text-align ">
                                                    <td>Tuesday</td>
                                                    <td v-if="this.u_tue_in!=''">{{u_tue_in}}</td>
                                                    <td v-if="this.u_tue_out!=''">{{u_tue_out}}</td>
                                                    <td v-else colspan="2" class="central-text-align">Weekend</td>
                                                </tr>
                                                <tr class="central-text-align ">
                                                    <td>Wednesday</td>
                                                    <td v-if="this.u_wed_in!=''">{{u_wed_in}}</td>
                                                    <td v-if="this.u_wed_out!=''">{{u_wed_out}}</td>
                                                    <td v-else colspan="2" class="central-text-align">Weekend</td>
                                                </tr>
                                                <tr class="central-text-align ">
                                                    <td>Thursday</td>
                                                    <td v-if="this.u_thu_in!=''">{{u_thu_in}}</td>
                                                    <td v-if="this.u_thu_out!=''">{{u_thu_out}}</td>
                                                    <td v-else colspan="2" class="central-text-align">Weekend</td>
                                                </tr>
                                                <tr class="central-text-align bgc-red-50">
                                                    <td>Friday</td>
                                                    <td v-if="this.u_fri_in!=''">{{u_fri_in}}</td>
                                                    <td v-if="this.u_fri_out!=''">{{u_fri_out}}</td>
                                                    <td v-else colspan="2" class="central-text-align">Weekend</td>

                                                </tr>
                                                <tr class="central-text-align ">
                                                    <td>Saturday</td>
                                                    <td v-if="this.u_sat_in!=''">{{u_sat_in}}</td>
                                                    <td v-if="this.u_sat_out!=''">{{u_sat_out}}</td>
                                                    <td v-else colspan="2" class="central-text-align">Weekend</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- END: Content-->
    </div>
</template>

<script>

    export default {
        data() {
            return {
                id: this.$route.params.id,
                value:'100',
                striped: true,
                emp_detail: {},
                exp_detail: {},
                com_year: '',
                max: 100,
                reporting1: '',
                reporting2: '',
                percent: {},

                leaves: {},
                leavesblnc: {},

                u_sun_in: '',
                u_sun_out: '',
                u_mon_in: '',
                u_mon_out: '',
                u_tue_in: '',
                u_tue_out: '',
                u_wed_in: '',
                u_wed_out: '',
                u_thu_in: '',
                u_thu_out: '',
                u_fri_in: '',
                u_fri_out: '',
                u_sat_in: '',
                u_sat_out: '',
            }
        },
        methods: {
            registered(id) {
                axios.get('./registered/' + id)
                    .then((response) => {
                        this.emp_detail = response.data
                        this.$toastr.s("Resigned Employee Successfully", "Congratulations!");

                    })
                    .catch(error => console.log(error));
            },
            resigned(id) {
                axios.get('./resigned_emp/' + id)
                    .then((response) => {
                        this.emp_detail = response.data
                        this.$toastr.s("Resigned Employee Successfully", "Congratulations!");

                    })
                    .catch(error => console.log(error));
            },
            suspend(id) {

                axios.get('./suspend_emp/' + id)
                    .then((response) => {
                        this.emp_detail = response.data
                        this.$toastr.s("Suspended Employee Successfully", "Congratulations!");

                    })
                    .catch(error => console.log(error));
            },
        },
        mounted() {
            axios.get('selected_emp_leaves/' + this.$route.params.id)
                .then(data => this.leaves = data.data)
                .catch(error => { });

            axios.get('selected_emp_leaves_blnc/' + this.$route.params.id)
                .then(data => this.leavesblnc = data.data)
                .catch(error => { });

            axios.get('selected_emp_timeTable/' + this.$route.params.id)
                .then(response => {
                    var u_mon = response.data[0].Mon.split('-');
                    this.u_mon_in = u_mon[0];
                    this.u_mon_out = u_mon[1];

                    var u_tue = response.data[0].Tue.split('-');
                    this.u_tue_in = u_tue[0];
                    this.u_tue_out = u_tue[1];

                    var u_wed = response.data[0].Wed.split('-');
                    this.u_wed_in = u_wed[0];
                    this.u_wed_out = u_wed[1];

                    var u_thu = response.data[0].Thu.split('-');
                    this.u_thu_in = u_thu[0];
                    this.u_thu_out = u_thu[1];

                    var u_fri = response.data[0].Fri.split('-');
                    this.u_fri_in = u_fri[0];
                    this.u_fri_out = u_fri[1];

                    var u_sat = response.data[0].Sat.split('-');
                    this.u_sat_in = u_sat[0];
                    this.u_sat_out = u_sat[1];

                    var u_sat = response.data[0].Sun.split('-');
                    this.u_sun_in = u_sat[0];
                    this.u_sun_out = u_sat[1];
                })
                .catch(error => { });

            axios.get('getindemployee_detail/' + this.$route.params.id)
                .then(data => {
                    this.emp_detail = data.data;
                    var rep_1 = data.data[0].ReportingTo.split('_');
                    this.reporting1 = rep_1[1];
                    var rep_2 = data.data[0].ReportingTo2.split('_');
                    this.reporting2 = rep_2[1];
                    var g = data.data[0].JoiningDate.split('-')
                    this.com_year = new Date().getFullYear() - new Date(g[0] + "-" + g[1] + "-" + g[2]).getFullYear()
                })
            axios.get('./success_array/' + this.id)
                .then((response) => this.percent = response.data)
        },
    }

</script>

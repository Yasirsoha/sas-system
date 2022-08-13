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
                                Employee
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
                            <!-- User Sidebar -->
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
                                        <h4 class="fw-bolder border-bottom pb-50 mb-1">Personel Details</h4>
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
                            <!--/ User Sidebar -->
                            <!-- User Content -->
                            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                                <!-- User Pills -->
                                <ul class="nav nav-pills mb-2" style="padding-left:20px !important">
                                    <li class="nav-item">
                                        <router-link  :to="{ name: 'employee_detail', params: { id: this.id }}" class="nav-link active">
                                            <i class="fa-solid fa-person"></i>
                                            <span class="fw-bold">Personal</span>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link :to="{ name: 'employee_leaves', params: { id: this.id }}" class="nav-link">
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
                                <div v-for='emp_detail1 in emp_detail' class="card">
                                    <div class="card-header">
                                        <div style="float:left">
                                            <h4 class="card-title mb-50">Complete Detail</h4>
                                        </div>
                                        <div style="float:right">
                                            <a v-if="percent.address+percent.city+percent.cnic+percent.company_email+percent.department+percent.designation+percent.dob+percent.edu_status+percent.email+percent.emp_code+percent.exp_status+percent.father+percent.gender+percent.job_des+percent.marital+percent.mobile+percent.photo+percent.reporting>89" target="_blank"
                                               v-bind:href="`../sa_sass1.1/cv_builder/${emp_detail1.EmployeeID}/${emp_detail1.EmployeeCode}/${emp_detail1.RegisterID}`" class="btn btn-primary btn-sm edit-address waves-effect waves-float waves-light">
                                                CV Builder
                                            </a>
                                            <a v-else target="_blank"
                                               href="#" class="btn btn-primary btn-sm edit-address waves-effect waves-float waves-light">
                                                CV Builder
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6 col-12">
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-6 fw-bolder mb-1">Employee Code:</dt>
                                                    <dd class="col-sm-6 mb-1">{{emp_detail1.EmployeeCode}}</dd>
                                                    <dt class="col-sm-6 fw-bolder mb-1">Reporting To:</dt>
                                                    <dd class="col-sm-6 mb-1">
                                                        <label>
                                                            {{rep_employees.rep1}}
                                                        </label>
                                                    </dd>
                                                    <dt class="col-sm-6 fw-bolder mb-1">Posting City:</dt>
                                                    <dd class="col-sm-6 mb-1">{{emp_detail1.PostingCity}}</dd>
                                                    <dt class="col-sm-6 fw-bolder mb-1">Com. Email:</dt>
                                                    <dd class="col-sm-6 mb-1">{{emp_detail1.CompanyEmail}}</dd>
                                                    <dt class="col-sm-6 fw-bolder mb-1">CNIC:</dt>
                                                    <dd class="col-sm-6 mb-1">{{emp_detail1.CNIC}}</dd>
                                                    <dt class="col-sm-6 fw-bolder mb-1">Job Shift:</dt>
                                                    <dd class="col-sm-6 mb-1">{{emp_detail1.JobShift}}</dd>
                                                    <dt class="col-sm-6 fw-bolder mb-1">Relation:</dt>
                                                    <dd class="col-sm-6 mb-1">{{emp_detail1.Relation}}</dd>
                                                    <dt class="col-sm-6 fw-bolder mb-1">Send Notification:</dt>
                                                    <dd v-if="emp_detail1.SendNotification==1" class="col-sm-6 mb-1">Allow</dd>
                                                    <dd v-else class="col-sm-6 mb-1">Not Allow</dd>
                                                    <dt class="col-sm-6 fw-bolder mb-1">Eportal Access:</dt>
                                                    <dd v-if="emp_detail1.EportalAccess==1" class="col-sm-6 mb-1">Allow</dd>
                                                    <dd v-else class="col-sm-6 mb-1">Not Allow</dd>
                                                    <dt class="col-sm-6 fw-bolder mb-1">Team Attendance:</dt>
                                                    <dd v-if="emp_detail1.AllowEmployeesAttendance==1" class="col-sm-6 mb-1">Yes</dd>
                                                    <dd v-else class="col-sm-6 mb-1">No</dd>
                                                </dl>
                                            </div>
                                            <div class="col-xl-6 col-12">
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-5 fw-bolder mb-1">Department:</dt>
                                                    <dd class="col-sm-7 mb-1">{{emp_detail1.Department}}</dd>
                                                    <dt class="col-sm-5 fw-bolder mb-1">Second Rep. To:</dt>
                                                    <dd class="col-sm-7 mb-1">
                                                        <label>
                                                            {{rep_employees.rep2}}
                                                        </label>
                                                    </dd>
                                                    <dt class="col-sm-5 fw-bolder mb-1">Joining Date:</dt>
                                                    <dd class="col-sm-7 mb-1">{{emp_detail1.JoiningDate}}</dd>
                                                    <dt class="col-sm-5 fw-bolder mb-1">Probation End:</dt>
                                                    <dd class="col-sm-7 mb-1">{{emp_detail1.ProbationEnd}}</dd>
                                                    <dt class="col-sm-5 fw-bolder mb-1">Blood Group:</dt>
                                                    <dd class="col-sm-7 mb-1">{{emp_detail1.BloodGroup}}</dd>
                                                    <dt class="col-sm-5 fw-bolder mb-1">CNIC Expiry:</dt>
                                                    <dd class="col-sm-7 mb-1">{{emp_detail1.CnicExpiry}}</dd>
                                                    <dt class="col-sm-5 fw-bolder mb-1">Job Status:</dt>
                                                    <dd class="col-sm-7 mb-1">{{emp_detail1.JobStatus}}</dd>
                                                    <dt class="col-sm-5 fw-bolder mb-1">Phone Number:</dt>
                                                    <dd class="col-sm-7 mb-1">{{emp_detail1.Phone}}</dd>
                                                    <dt class="col-sm-5 fw-bolder mb-1">Complete Address:</dt>
                                                    <dd class="col-sm-7 mb-1">{{emp_detail1.Address}}, {{emp_detail1.City}}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Project table -->
                                <div class="card">
                                    <h4 class="card-header">Qualification List</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Institute Name</th>
                                                    <th>Degree Type</th>
                                                    <th>Degree Name</th>
                                                    <th>Passing Year</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align:center">
                                                <tr v-for='edu_detail1 in edu_detail'>
                                                    <td></td>
                                                    <td style="text-align:left">{{edu_detail1.InstituteName}}</td>
                                                    <td style="text-align:left">{{edu_detail1.DegreeType}}</td>
                                                    <td style="text-align:left">{{edu_detail1.DegreeName}}</td>
                                                    <td style="text-align:left">{{edu_detail1.PassingYear}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card">
                                    <h4 class="card-header">Work Experience</h4>
                                    <div class="card-body pt-1">
                                        <ul v-for='exp_detail1 in exp_detail' class="timeline ms-50">
                                            <li class="timeline-item">
                                                <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                                                <div class="timeline-event">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                        <h6>{{exp_detail1.JobTitle}}</h6>
                                                        <span class="timeline-event-time me-1">{{exp_detail1.StartingDate}} to {{exp_detail1.LeavingDate}}</span>
                                                    </div>
                                                    <p>{{exp_detail1.CompanyName}}</p>
                                                    <div class="d-flex flex-row align-items-center mb-50">
                                                        <div style="margin-left:30px" class="avatar me-50">

                                                        </div>
                                                        <div class="user-info">
                                                            <h6 class="mb-0">Reference Name</h6>
                                                            <p class="mb-0">{{exp_detail1.Refrence}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card">
                                    <h4 class="card-header">Remarks</h4>
                                    <div class="card-body pt-1" v-for="emp_detail1 in emp_detail">
                                        <label v-html='emp_detail1.remarks'></label>
                                    </div>
                                </div>
                                <!-- /Activity Timeline -->
                            </div>
                            <!--/ User Content -->
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

                rep1:'',
                rep2:'',
                striped: true,
                emp_detail: {},
                edu_detail: {},
                exp_detail: {},
                rep_employees: {},

                com_year: '',
                max: 100,
                reporting1: '',
                reporting2: '',
                percent: {},
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
            axios.get('getindemployee_detail/' + this.$route.params.id)
                .then(data => {
                    this.emp_detail = data.data;
                    var rep_1 = data.data[0].ReportingTo.split('_');
                    this.reporting1 = rep_1[0];
                    var rep_2 = data.data[0].ReportingTo2.split('_');
                    this.reporting2 = rep_2[1];
                    var g = data.data[0].JoiningDate.split('-')
                    this.com_year = new Date().getFullYear() - new Date(g[0] + "-" + g[1] + "-" + g[2]).getFullYear()
                })

            axios.get('getemployee_education/' + this.$route.params.id)
                .then(data => {
                    this.edu_detail = data.data;
                })

            axios.get('getemployee_exp/' + this.$route.params.id)
                .then(data => {
                    this.exp_detail = data.data;
                })

            axios.get('reporting_employees/' + this.$route.params.id)
                .then(data => {
                    this.rep_employees = data.data;
                })

            axios.get('./success_array/' + this.$route.params.id)
                .then((response) => this.percent = response.data)
        },
    }

</script>

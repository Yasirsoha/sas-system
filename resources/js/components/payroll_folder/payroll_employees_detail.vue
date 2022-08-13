<template>
    <div>
        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <router-link to="/" style="text-decoration: none;">Dashboard</router-link>
                            </li>
                            <li class="breadcrumb-item active">
                                Payroll Employees Detail
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
                                <div class="col-md-7">
                                    <div class="card-header">
                                        <h2 style="font-size:28px" class="card-title">Employees Payroll Detail</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Search &amp; Filter</h4>
                                <div class="row">
                                    <div class="col-md-2 user_role">
                                        <label class="form-label" for="UserRole">Employee Code<span style="color:red"></span></label>
                                        <select id="UserRole" v-model="emp_code" class="form-select mb-md-0 mb-2">
                                            <option value="All">Employee Code</option>
                                            <option v-for='find_emp1 in find_emp' :value='find_emp1.EmployeeID'>{{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}</option>
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
                                        <thead style="">
                                            <tr>
                                                <th></th>
                                                <th style="max-width:40px;border-right:1px solid lightgrey">Emp Code</th>
                                                <th style="border-right:1px solid lightgrey">Emp Name</th>
                                                <th style="border-right:1px solid lightgrey">Department</th>
                                                <th style="border-right:1px solid lightgrey">Updated Salary</th>
                                                <th style="border-right:1px solid lightgrey">Updated Date</th>
                                                <th style="border-right:1px solid lightgrey"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="adsdata1 in adsdata.data">
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
                                                <td style="border-right:1px solid lightgrey">
                                                    <div class="d-flex flex-column"><a class="user_name text-truncate text-body"><span class="fw-bolder"> </span>Rs. {{adsdata1.UpdatedSalary}}/-</a><small class="emp_post text-muted">Per Day: Rs. {{adsdata1.UpdatedPerDay}}  | Per Hour: Rs. {{adsdata1.UpdatedPerHours}} </small></div>
                                                </td>
                                                <td style="text-align:center;border-right:1px solid lightgrey">
                                                    {{adsdata1.UpdatedDate}}
                                                </td>
                                                <td style="text-align:center;border-right:1px solid lightgrey">

                                                    <a data-bs-toggle="modal" data-bs-target="#addNewCard" type="button"><i class="fa-solid fa-eye"></i></a>
                                                    <a data-bs-toggle="modal" @click="fetchdata(adsdata1.EmployeeID)" data-bs-target="#updatestatus" type="button"><i class="fa-solid fa-pencil"></i></a>
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

        <div class="modal fade" id="updatestatus" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" @click="update_salary_detail1()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h4 class="mb-1">Update Employee Payroll</h4>

                        </div>
                        <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">
                            <div class="col-12 col-md-4">
                                <label class="form-label">Employee Code</label>
                                <input type="text" readonly class="form-control" v-model="p_emp_code" />
                                <input type="text" hidden readonly class="form-control" v-model="p_emp_id" />
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label">Employee name</label>
                                <input type="text" readonly class="form-control" v-model="p_name" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Designation</label>
                                <input type="text" readonly class="form-control" v-model="p_designation" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="modalEditUserLastName">Department</label>
                                <input type="text" readonly class="form-control" v-model="p_department" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="modalEditUserLastName">Posting City</label>
                                <input type="text" readonly class="form-control" v-model="p_postingcity" />
                            </div>
                            <div class="col-12 col-md-2">
                                <label class="form-label">Last Date</label>
                                <input type="text" readonly class="form-control" v-model="p_last_date" />
                            </div>
                            <div class="col-12 col-md-2">
                                <label class="form-label">Last Salary</label>
                                <input type="text" readonly class="form-control" v-model="p_last_salary" />
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label">Last Increment Amount</label>
                                <input type="text" readonly class="form-control" v-model="p_last_increment" />
                            </div>
                            <div class="col-12 col-md-8">
                                <label class="form-label" for="modalEditUserLastName">Last Remarks</label>
                                <input type="text" readonly v-model="p_last_remarks" class="form-control" placeholder="Comments" />
                            </div>

                            <hr style="margin-top:20px">

                            <div class="col-12 col-md-4">
                                <label class="form-label">New Salary</label>
                                <input type="number" @change="calculator()" class="form-control" v-model="p_current_salary" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Per Day</label>
                                <input readonly type="number" class="form-control" v-model="p_current_day" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Per Hour</label>
                                <input readonly type="number" class="form-control" v-model="p_current_hour" />
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="form-label" for="modalEditUserLastName">Last Remarks</label>
                                <input type="text" v-model="p_current_remarks" class="form-control" />
                            </div>

                            <div class="col-12 text-center mt-2 pt-50">
                                <button :disabled="disabled" @click="delay()" type="submit" class="btn btn-primary me-1" data-bs-dismiss="modal" aria-label="Close">Update</button>
                                <button type="reset" @click="update_salary_detail1()" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                    Cancle
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                department: 'All',
                location: 'All',
                designation: 'All',
                designations: {},
                locations: {},
                departments: {},
                adsdata: {},
                find_emp: {},
                emp_code: 'All',

                p_emp_code: '',
                p_emp_id: '',
                p_name: '',
                p_designation: '',
                p_department: '',
                p_postingcity: '',
                p_last_date: '',
                p_last_increment: '',
                p_last_salary: '',
                p_last_remarks: '',
                p_current_salary: '',
                p_current_day: '',
                p_current_hour: '',
                p_current_remarks: '',

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
                this.update_salary_detail()
            },
            calculator() {
                this.p_current_day = this.p_current_salary / 30;
                this.p_current_hour = this.p_current_day / 8;
            },
            update_salary_detail1() {
                this.p_emp_code = '';
                this.p_emp_id = '';
                this.p_name = '';
                this.p_designation = '';
                this.p_department = '';
                this.p_postingcity = '';
                this.p_last_date = '';
                this.p_last_increment = '';
                this.p_last_salary = '';
                this.p_last_remarks = '';
                this.p_current_salary = '';
                this.p_current_day = '';
                this.p_current_hour = '';
                this.p_current_remarks = '';
            },
            update_salary_detail() {
                axios.post('submit_payroll_detail', {
                    p_emp_id: this.p_emp_id,
                    p_last_salary: this.p_last_salary,
                    p_current_salary: this.p_current_salary,
                    p_current_day: this.p_current_day,
                    p_current_hour: this.p_current_hour,
                    p_current_remarks: this.p_current_remarks,
                })
                    .then(data => {
                        this.adsdata = data.data
                        this.$toastr.s("Submitted Employee Salary Detail Successfully!", "Congratulations");
                        this.p_emp_id = '';
                        this.p_last_salary = '';
                        this.p_current_salary = '';
                        this.p_current_day = '';
                        this.p_current_hour = '';
                        this.p_current_remarks = '';

                    })
            },
            fetchdata(id) {
                axios.get('./fetch_emp_detail/' + id)
                    .then(data => {
                        this.p_emp_code = data.data[0].EmployeeCode;
                        this.p_name = data.data[0].Name;
                        this.p_designation = data.data[0].Designation;
                        this.p_department = data.data[0].Department;
                        this.p_postingcity = data.data[0].PostingCity;
                        this.p_last_date = data.data[0].UpdatedDate;
                        this.p_last_increment = data.data[0].LastIncrement;
                        this.p_last_salary = data.data[0].UpdatedSalary;
                        this.p_last_remarks = data.data[0].Remarks;
                        this.p_emp_id = data.data[0].EmployeeID;
                    })
                    .catch(error => { });
            },

            getbyfilter(page = 1) {

                axios.get('./filter_employees/' + this.emp_code + '/' + this.department + '/' + this.location + '/' + this.designation + '?page=' + page)
                    .then(data => this.adsdata = data.data)
                    .catch(error => { });


            },
            getResult(page = 1) {
                axios.get('overall_payroll_employees?page=' + page)
                    .then(response => this.adsdata = response.data)
                    .catch(error => { });
            },

        },

        mounted() {
            axios.get('find_emp_id')
                .then(data => this.find_emp = data.data)
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

            axios.get('find_emp_id')
                .then(data => this.find_emp = data.data)
                .catch(error => { });
            this.getResult();
        }
    }

</script>

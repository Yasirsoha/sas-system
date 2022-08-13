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
                                Employees Details
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="content-body">
                    <!-- users list start -->
                    <section class="app-user-list">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{count_users.all_users}}</h3>
                                            <span>Total Employees</span>
                                        </div>
                                        <div class="avatar bg-light-primary p-50">
                                            <span class="avatar-content">
                                                <i class="fa-solid fa-users"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{count_users.active_users}}</h3>
                                            <span>Active Employees</span>
                                        </div>
                                        <div class="avatar bg-light-success p-50">
                                            <span class="avatar-content">
                                                <i class="fa-solid fa-user-shield"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{count_users.inactive_users}}</h3>
                                            <span>Resigned Employees</span>
                                        </div>
                                        <div class="avatar bg-light-warning p-50">
                                            <span class="avatar-content">
                                                <i class="fa-solid fa-user-large-slash"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{count_users.incomplete_users}}</h3>
                                            <span>Incomplete Profiles</span>
                                        </div>
                                        <div class="avatar bg-light-warning p-50">
                                            <span class="avatar-content">
                                                <i class="fa-solid fa-user-large-slash"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div clas="card" style="background-color:white !important">
                            <div class="card-body border-bottom">
                                <h4 class="card-title">Search &amp; Filter</h4>
                                <div class="row">
                                    <div class="col-md-3 user_role">
                                        <label class="form-label" for="UserRole">Designation</label>
                                        <select id="UserRole" v-model="designation" class="form-select mb-md-0 mb-2">
                                            <option value="All">All Designations </option>
                                            <option v-for='designation1 in designations' :value='designation1.designation_name'>{{ designation1.designation_name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 user_plan">
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
                                        <label class="form-label" for="accountPhoneNumber">Employee Status</label>
                                        <select class="form-select" v-model="emp_status">
                                            <option value="All">Select Status</option>
                                            <option value="Suspended">Suspended</option>
                                            <option value="Terminate">Terminate</option>
                                            <option value="Resigned">Resigned</option>
                                            <option value="Registered">Registered</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 user_status">
                                        <button @click="getbyfilter()" style="background:#c1c1c1;width:100%;height: 40px !important;margin-bottom:20px;width: 60% !important;" class="btn btn-common">Search</button>
                                        <a v-b-toggle.my-collapse style="margin-left:10px;background:transparent;font-weight:900"> <i aria-hidden="true" class="fas fa-cogs" style="padding-right:10px;font-size:28px;margin-top:30px"></i></a>
                                        <label style="color: #d93025" v-if="designation=='' && location=='' && department=='' && status=='' && min_price=='' && max_price=='' && cnic=='' && gender=='' & emp_id==''">{{e_search}}</label>
                                    </div>
                                </div>
                                <b-collapse id="my-collapse">
                                    <div style="min-height: 70px;" class="advanced">
                                        <div class="container">
                                            <div class="row" style=" display: block; padding-top:10px;padding-bottom:10px">
                                                <div class="col-md-2" style="float:left">
                                                    <select id="FilterTransaction" v-model="status" class="form-select text-capitalize mb-md-0 mb-2xx">
                                                        <option value="All">All Job Status </option>
                                                        <option value="Probation">Probation</option>
                                                        <option value="Contract">Contract</option>
                                                        <option value="Parmanent">Parmanent</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2" style="float:left">
                                                    <b-form-input type="number" style="height: 40px !important;border-radius: 5px !important;" v-model="min_price" id="inline-form-input-name" class="mb-2 mr-sm-2 mb-sm-0" placeholder="Min Salary" min="0"></b-form-input>
                                                </div>
                                                <div class="col-md-2" style="float:left">
                                                    <b-form-input type="number" style="height: 40px !important;border-radius: 5px !important;" v-model="max_price" id="inline-form-input-name" class="mb-2 mr-sm-2 mb-sm-0" placeholder="Max Salary" min="0"></b-form-input>
                                                    <label style="color: #d93025; font-size:11px; text-align:justify;" v-if="min_price!='' && max_price!='' && max_price<=min_price">Maximum salary must be greater then minimum salary!</label>
                                                </div>
                                                <div class="col-md-2" style="float:left">
                                                    <masked-input class="form-control account-number-mask" style="height: 40px !important;border-radius: 5px !important;" id="inline-form-input-name" v-model="cnic" mask="11111-1111111-1" placeholder="CNIC" />
                                                </div>
                                                <div class="col-md-2" style="float:left">
                                                    <select id="FilterTransaction" v-model="gender" class="form-select text-capitalize mb-md-0 mb-2xx">
                                                        <option value="All">Gender </option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2" style="float:left">
                                                    <b-form-input type="number" style="height: 40px !important;border-radius: 5px !important;" v-model="emp_id" id="inline-form-input-name" class="mb-2 mr-sm-2 mb-sm-0" placeholder="Employee Code"></b-form-input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </b-collapse>
                            </div>
                            <div style="margin-bottom:20px;" class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-12 ps-xl-75 ps-0">
                                    <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="me-1">
                                            <div class="dataTables_filter" style="margin-top:5px">
                                                <label>
                                                    <input autocomplete="off" id="keyword1" type="text" name="keyword1" v-model="keyword1" class="form-control" style="" placeholder="Search By First Name" />
                                                </label>
                                            </div>
                                        </div>
                                        <div class="dt-buttons d-inline-flex mt-50">
                                            <router-link to="/hr/create_employee" class="dt-button add-new btn btn-primary" tabindex="0" type="button"><span>Add New Employee</span></router-link>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" style="overflow-x: initial !important;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; max-width: 148px; vertical-align: middle !important;">Emp. <br />Code</th>
                                            <th style="text-align:center; vertical-align:middle !important;">Name & Designation</th>
                                            <th style="text-align: center; vertical-align: middle !important;">Department</th>
                                            <th style="text-align: center; vertical-align: middle !important;">Build Profile</th>
                                            <th style="text-align: center; max-width: 70px; vertical-align: middle !important;">Status</th>
                                            <th style="max-width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd" v-for="adsdata1 in adsdata.data">
                                            <td class="control" tabindex="0" style="display: none;"></td>
                                            <td style="vertical-align: middle !important; text-align: center;">
                                                <span v-if="adsdata1.EmployeeCode!=null">{{adsdata1.EmployeeCode}}</span>
                                                <span v-else></span>
                                            </td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar  me-1">
                                                            <img v-if="adsdata1.Photo=='' || adsdata1.Photo==null" src="public/images/profile_images/pro.png" alt="Avatar" height="32" width="32">
                                                            <img v-else v-bind:src="`public/images/profile_images/${adsdata1.Photo}`" alt="Avatar" height="32" width="32">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a class="user_name text-truncate text-body"><span class="fw-bolder">{{adsdata1.Name}} </span></a><small class="emp_post text-muted">
                                                            Designation: <span v-if="adsdata1.Designation!=null">{{adsdata1.Designation}}</span>
                                                            <span v-else></span>
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td style="vertical-align: middle !important; text-align: center;" class="control" tabindex="0">
                                                <span v-if="adsdata1.Department!=null">{{adsdata1.Department}}</span>
                                                <span v-else></span>
                                            </td>
                                            <td style="vertical-align: middle !important;">
                                                <router-link :to="{ name: 'update_employee_profile', params: { id: adsdata1.EmployeeID }}" class="me-50">
                                                    <span v-if="adsdata1.Name==null||adsdata1.Name==''" class="badge  rounded-pill badge-light-danger">Personal Detail</span>
                                                    <span v-else class="badge  rounded-pill badge-light-primary">Personal Detail</span>
                                                </router-link>
                                                <router-link v-if="adsdata1.EduStatus==null||adsdata1.EduStatus==''||adsdata1.EduStatus=='skip'" :to="{ name: 'create_employee_education', params: { id: adsdata1.EmployeeID }}" class="me-50">
                                                    <span v-if="adsdata1.EduStatus==null||adsdata1.EduStatus==''" class="badge  rounded-pill badge-light-danger">Education</span>
                                                    <span v-else class="badge  rounded-pill badge-light-primary">Education</span>
                                                </router-link>
                                                <router-link v-else :to="{ name: 'update_education_profile', params: { id: adsdata1.EmployeeID }}" class="me-50">

                                                    <span class="badge  rounded-pill badge-light-primary">Education</span>
                                                </router-link>
                                                <router-link v-if="adsdata1.ExpStatus==null||adsdata1.ExpStatus==''||adsdata1.ExpStatus=='skip'" :to="{ name: 'create_employee_experience', params: { id: adsdata1.EmployeeID }}" class="me-50">
                                                    <span v-if="adsdata1.ExpStatus==null||adsdata1.ExpStatus==''" class="badge  rounded-pill badge-light-danger">Experience</span>
                                                    <span v-else class="badge  rounded-pill badge-light-primary">Experience</span>
                                                </router-link>
                                                <router-link v-else :to="{ name: 'update_experience_profile', params: { id: adsdata1.EmployeeID }}" class="me-50">

                                                    <span class="badge  rounded-pill badge-light-primary">Experience</span>
                                                </router-link>

                                                <router-link :to="{ name: 'create_employee_employeement', params: { id: adsdata1.EmployeeID }}" class="me-50">
                                                    <span v-if="adsdata1.Status==null||adsdata1.Status==''" class="badge rounded-pill badge-light-danger">Employement</span>
                                                    <span v-else class="badge rounded-pill badge-light-primary">Employement</span>
                                                </router-link>
                                                <router-link :to="{ name: 'create_documents', params: { id: adsdata1.EmployeeID }}" class="me-50">

                                                    <span v-if="adsdata1.DocStatus==null||adsdata1.DocStatus==''" class="badge rounded-pill badge-light-danger">Documents</span>
                                                    <span v-else class="badge rounded-pill badge-light-primary">Documents</span>
                                                </router-link>
                                            </td>
                                            <td style="vertical-align: middle !important; text-align: center;">
                                                <span v-if="adsdata1.Status==null" class=""></span>
                                                <span v-else-if="adsdata1.Status=='Registered'" class="badge badge-glow bg-primary">{{adsdata1.Status}}</span>
                                                <span v-else class="badge badge-glow bg-secondary">{{adsdata1.Status}}</span>

                                            </td>
                                            <td style="vertical-align: middle !important;">
                                                <router-link :to="{ name: 'employee_detail', params: { id: adsdata1.EmployeeID }}"><i class="fa-solid fa-eye"></i></router-link>

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div style="text-align:center;padding-top:20px">
                                <pagination :data="adsdata" @pagination-change-page="getResult"></pagination>
                            </div>
                        </div>
                    </section>
                    <!-- users list ends -->
                </div>
            </div>
        </div>
        <!-- END: Content-->

    </div>
</template>
<script>
    import MaskedInput from 'vue-masked-input'
    export default {
        data() {
            return {
                user_access:{},
                adsdata: {},
                success: '',
                keyword1: '',

                gender: 'All',
                status: 'All',
                min_price: '',
                max_price: '',
                cnic: '',
                department: 'All',
                location: 'All',
                designation: 'All',
                emp_status: 'All',

                min_price_s: '',
                max_price_s: '',
                cnic_s: '',
                emp_id_s: '',

                designations: {},
                locations: {},
                departments: {},

                emp_id: '',

                e_search: '',
                count_users: {},
                currentPage: 1,
            }
        },
        components: {
            MaskedInput
        },
        watch: {
            keyword1(after, before) {
                this.getResults();
            }
        },
        methods: {
            getResults() {

                axios.get('./search_emp', { params: { keyword1: this.keyword1 } })
                    .then(response => this.adsdata = response.data)
                    .catch(error => console.log(error));
            },
            getbyfilter(page = 1) {

                if (this.min_price == '') {
                    this.min_price_s = "All";
                }
                else {
                    this.min_price_s = this.min_price;
                }
                if (this.max_price == '') {
                    this.max_price_s = "All";
                }
                else {
                    this.max_price_s = this.max_price;
                }
                if (this.cnic == '') {
                    this.cnic_s = "All";
                }
                else {
                    this.cnic_s = this.cnic;
                }
                if (this.emp_id == '') {
                    this.emp_id_s = "All";
                }
                else {
                    this.emp_id_s = this.emp_id;
                }
                axios.get('./searchemployee/' + this.department + '/' + this.location + '/' + this.designation + '/' + this.gender + '/' + this.status + '/' + this.min_price_s + '/' + this.max_price_s + '/' + this.cnic_s + '/' + this.emp_id_s + '/' + this.emp_status + '?page=' + page)
                    .then(data => this.adsdata = data.data)
                    .catch(error => this.error = error.response.data.errors)
            },
            getResult(page = 1) {
                this.currentPage = page;
                axios.get('./hr/getEmployeedetail/?page=' + page)
                    .then(response => this.adsdata = response.data)
                    .catch(error => { });
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
            axios.get('./count_employees')
                .then(response => this.count_users = response.data)
                .catch(error => { });

            axios.get('./fetch_user_hr_roles')
                .then(response => this.user_access = response.data)
            this.getResult();
        }
    }

</script>

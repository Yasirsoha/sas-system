<template>
    <div>
        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <!-- users list start -->
                    <section class="app-user-list">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{count_users.all_users}}</h3>
                                            <span>Total Users</span>
                                        </div>
                                        <div class="avatar bg-light-primary p-50">
                                            <span class="avatar-content">
                                                <i class="fa-solid fa-users"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{count_users.active_users}}</h3>
                                            <span>Active Users</span>
                                        </div>
                                        <div class="avatar bg-light-success p-50">
                                            <span class="avatar-content">
                                                <i class="fa-solid fa-user-shield"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{count_users.inactive_users}}</h3>
                                            <span>Not Active Users</span>
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
                                    <div class="col-md-4 user_role"><label class="form-label" for="UserRole">Designation</label>
                                        <select id="UserRole" @change='getdesignationwise()' v-model="designation" class="form-select mb-md-0 mb-2">
                                            <option value="">All Designations </option>
                                            <option v-for='designation1 in designations' :key="designation1" :value='designation1.designation_name'>{{ designation1.designation_name }}</option>
                                        </select></div>
                                    <div class="col-md-4 user_plan"><label class="form-label" for="UserPlan">Location</label>
                                        <select v-model="location" @change='getlocationwise()' id="UserPlan" class="form-select mb-md-0 mb-2">
                                            <option value="">All Locations </option>
                                            <option v-for='locations1 in locations' :key="locations1" :value='locations1.location_name'>{{ locations1.location_name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 user_status"><label class="form-label" for="FilterTransaction">Status</label>
                                        <select id="FilterTransaction" v-model="status" @change='getstatuswise()' class="form-select text-capitalize mb-md-0 mb-2xx">
                                            <option value="">Both Status </option>
                                            <option value="Active">Active</option>
                                            <option value="Not Active">Not Active</option>
                                        </select></div>
                                </div>
                            </div>
                            <div style="margin-bottom:20px;" class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-12 ps-xl-75 ps-0">
                                    <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="me-1">
                                            <div class="dataTables_filter" style="margin-top:5px"><label>
                                                    <input autocomplete="off" id="keyword1" type="text" name="keyword1" v-model="keyword1" class="form-control" style="" placeholder="Search By First Name" />
                                                </label></div>
                                        </div>
                                        <div class="dt-buttons d-inline-flex mt-50">
                                            <router-link to="/settings/create_user" class="dt-button add-new btn btn-primary" tabindex="0" type="button"><span>Add New User</span></router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" style="overflow-x: initial !important;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Password</th>
                                            <th>Employee Code</th>
                                            <th>Office Location</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd" v-for="adsdata1 in adsdata.data" :key="adsdata1">
                                            <td class=" control" tabindex="0" style="display: none;"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar  me-1">
                                                            <img src="public/app-assets/images/avatars/2.png" alt="Avatar" height="32" width="32"></div>
                                                    </div>
                                                    <div class="d-flex flex-column"><a class="user_name text-truncate text-body"><span class="fw-bolder">{{adsdata1.first_name}} {{adsdata1.last_name}}</span></a><small class="emp_post text-muted">{{adsdata1.email}}</small></div>
                                                </div>
                                            </td>
                                            <td>{{adsdata1.user_password}}</td>
                                            <td>{{adsdata1.emp_code}}</td>
                                            <td>{{adsdata1.ofc_location}}</td>
                                            <td><span class="text-truncate align-middle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database font-medium-3 text-success me-50">
                                                        <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                                                    </svg>{{adsdata1.user_role}}</span></td>
                                            <td>
                                                <span v-if="adsdata1.u_status=='Active'" class="badge bg-light-success">{{adsdata1.u_status}}</span>
                                                <span v-else class="badge bg-light-danger">{{adsdata1.u_status}}</span></td>
                                            
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                                                            <circle cx="12" cy="12" r="1"></circle>
                                                            <circle cx="12" cy="5" r="1"></circle>
                                                            <circle cx="12" cy="19" r="1"></circle>
                                                        </svg></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <router-link :to="{ name: 'update_user', params: { id: adsdata1.id }}" class="dropdown-item">
                                                            Edit</router-link>
                                                        <a @click="savecompany_id(adsdata1.id,adsdata1.email)" v-b-modal.modal-lg class="dropdown-item">
                                                            User Access</a>
                                                        <button v-if="adsdata1.u_status=='Active'" @click="deactive(adsdata1.id)" class="dropdown-item">
                                                            Suspend</button>
                                                        <button v-if="adsdata1.u_status=='Not Active'" @click="active(adsdata1.id)" class="dropdown-item">
                                                            Activate</button>
                                                    </div>
                                                </div>
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
        <b-modal id="modal-lg" size="xl" title="Role Permissions To User" ok-only>
            <div class="col-12">
                <input type="text" hidden v-model="id" />
                <input type="text" hidden v-model="email" />
                <div v-if="success=='Updated Status Successfully'" style="margin-top:5px;margin-bottom:5px;">
                    <p class="alert alert-info" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px"> {{success}}</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-flush-spacing">
                        <tbody>
                            <tr>
                                <td class="text-nowrap fw-bolder">
                                    HR Management System
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system">
                                        <i data-feather="info"></i>
                                    </span>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="hr_read" value="true" style="30px" @change="check($event,'hr')">Read</b-form-checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="hr_write" value="true" style="30px" @change="check($event,'hr')">Write</b-form-checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="hr_overall" value="true" style="30px" @change="check($event,'hr')">Overall</b-form-checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="hr_superadmin" value="true" style="30px" @change="check($event,'hr')">Admin</b-form-checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="hr_restricted" value="true" style="30px" @change="check($event,'hr')">User</b-form-checkbox>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-nowrap fw-bolder">
                                    HR PAYROLL
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system">
                                        <i data-feather="info"></i>
                                    </span>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="payroll_read" value="true" style="30px" @change="check($event,'hr')">Read</b-form-checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="payroll_write" value="true" style="30px" @change="check($event,'hr')">Write</b-form-checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="payroll_overall" value="true" style="30px" @change="check($event,'hr')">Overall</b-form-checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="payroll_superadmin" value="true" style="30px" @change="check($event,'hr')">Admin</b-form-checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="payroll_restricted" value="true" style="30px" @change="check($event,'hr')">User</b-form-checkbox>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td class="text-nowrap fw-bolder">
                                    Accounts Management System
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system">
                                        <i data-feather="info"></i>
                                    </span>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="accounts_read" value="true" style="30px" @change="check($event,'accounts')">Read</b-form-checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="accounts_write" value="true" style="30px" @change="check($event,'accounts')">Write</b-form-checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="accounts_overall" value="true" style="30px" @change="check($event,'accounts')">Overall</b-form-checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <b-form-checkbox v-model="accounts_superadmin" value="true" style="30px" @change="check($event,'accounts')">Admin</b-form-checkbox>
                                    </div>
                                </td>
                               
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Permission table -->
            </div>
        </b-modal>
    </div>
</template>
<script>
export default {
    data() {
        return {
            adsdata: {

            },
            success: '',
            hr_read: '',
            hr_write: '',
            hr_restricted: '',
            hr_superadmin: '',
            hr_overall: '',
            keyword1: '',
            status: '',
            location: '',
            designation: '',
            designations: {},
            locations: {},
            id: '',
            email: '',
            count_users: {},


            payroll_read: '',
            payroll_write: '',
            payroll_restricted: '',
            payroll_superadmin: '',
            payroll_overall: '',

            accounts_read: '',
            accounts_write: '',
            accounts_overall: '',
            accounts_superadmin: '', 
        }
    },
    methods: {
        check: function(e, mod_name) {
            this.module_name = mod_name;

            axios.post('submit_user_roles', {
                    id: this.id,
                    email: this.email,
                    hr_read: this.hr_read,
                    hr_write: this.hr_write,
                    hr_restricted: this.hr_restricted,
                    hr_superadmin: this.hr_superadmin,
                    hr_overall: this.hr_overall,
                    payroll_read: this.payroll_read,
                    payroll_write: this.payroll_write,
                    payroll_restricted: this.payroll_restricted,
                    payroll_superadmin: this.payroll_superadmin,
                    payroll_overall: this.payroll_overall,
                    accounts_read: this.accounts_read,
                    accounts_write: this.accounts_write,
                    accounts_overall: this.accounts_overall,
                    accounts_superadmin: this.accounts_superadmin,

                })
                .then(data => {
                    if (data.data == 'Updated Status Successfully') {
                        this.$toastr.s("Updated Status Successfully", "Congratulations");

                    } else {
                        console.log(data.data);
                    }
                })
                .catch(error => {});


        },
        getResult(page = 1) {

            axios.get('users_detail/?page=' + page)
                .then(response => this.adsdata = response.data)
                .catch(error => {});
        },
        getResults() {

            axios.get('./search_users', { params: { keyword1: this.keyword1 } })
                .then(response => this.adsdata = response.data)
                .catch(error => console.log(error));
        },
        getstatuswise(page = 1) {


            axios.post('./get_statuswise_users?page=' + page, {
                    status: this.status,
                })
                .then(data => {

                    this.adsdata = data.data;

                })
                .catch(error => this.error = error.response.data.errors)



        },
        getdesignationwise(page = 1) {

            axios.post('./get_designationwise_users?page=' + page, {
                    designation: this.designation,
                })
                .then(data => {
                    this.adsdata = data.data;
                })
                .catch(error => this.error = error.response.data.errors)

        },
        getlocationwise(page = 1) {

            axios.post('./get_locationwise_users?page=' + page, {
                    location: this.location,
                })
                .then(data => {
                    this.adsdata = data.data;
                })
                .catch(error => this.error = error.response.data.errors)

        },
        deactive(id) {

            axios.get('./deactivate_user/' + id)
                .then((response) => this.adsdata = response.data)
                .catch(error => console.log(error));
            axios.get('./count_users')
                .then(response => this.count_users = response.data)
                .catch(error => {});
        },
        active(id) {

            axios.get('./activate_user/' + id)
                .then((response) => this.adsdata = response.data)
                .catch(error => console.log(error));
            axios.get('./count_users')
                .then(response => this.count_users = response.data)
                .catch(error => {});
        },
        savecompany_id(id, email) {
            this.id = id;
            this.email = email;
            axios.get('fetch_user_roles/' + this.email)
                .then(response => {
                    this.hr_read = response.data[0].hr_read;
                    this.hr_write = response.data[0].hr_write;
                    this.hr_restricted = response.data[0].hr_restricted;
                    this.hr_superadmin = response.data[0].hr_superadmin;
                    this.hr_overall = response.data[0].hr_overall;
                    this.payroll_read = response.data[0].payroll_read;
                    this.payroll_write = response.data[0].payroll_write;
                    this.payroll_restricted = response.data[0].payroll_restricted;
                    this.payroll_superadmin = response.data[0].payroll_superadmin;
                    this.payroll_overall = response.data[0].payroll_overall;
                     this.accounts_read = response.data[0].accounts_read;
                    this.accounts_write = response.data[0].accounts_write;
                    this.accounts_overall = response.data[0].accounts_overall;
                    this.accounts_superadmin = response.data[0].accounts_superadmin;
                })
                .catch(error => {});
        }
    },
    watch: {
        keyword1(after, before) {
            this.getResults();
        }
    },
    mounted() {

        axios.get('overall_designation')
            .then(response => this.designations = response.data)
            .catch(error => {});
        axios.get('overall_location')
            .then(response => this.locations = response.data)
            .catch(error => {});
        axios.get('./count_users')
            .then(response => this.count_users = response.data)
            .catch(error => {});


        this.getResult();
    }
}

</script>

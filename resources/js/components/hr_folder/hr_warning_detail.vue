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
                                Warning Details
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
                                            <h3 class="fw-bolder mb-75">{{count_users.total}}</h3>
                                            <span>Total Warnings</span>
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
                                            <h3 class="fw-bolder mb-75">{{count_users.first}}</h3>
                                            <span>First Warning</span>
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
                                            <h3 class="fw-bolder mb-75">{{count_users.second}}</h3>
                                            <span>Second Warning</span>
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
                                            <h3 class="fw-bolder mb-75">{{count_users.terminate}}</h3>
                                            <span>Terminate</span>
                                        </div>
                                        <div class="avatar bg-light-warning p-50">
                                            <span class="avatar-content">
                                                <i style="color:red" class="fa-solid fa-user-large-slash"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div clas="card" style="background-color:white !important">
                            <div class="card-body border-bottom">
                                <h4 class="card-title">Search & Filter</h4>
                                <div class="row">
                                    <div class="col-md-3 user_role">
                                        <label class="form-label" for="UserRole">Designation</label>
                                        <select id="UserRole" v-model="designation" class="form-select mb-md-0 mb-2">
                                            <option value="">All Designations </option>
                                            <option v-for='designation1 in designations' :value='designation1.designation_name'>{{ designation1.designation_name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 user_plan">
                                        <label class="form-label" for="UserPlan">Location</label>
                                        <select v-model="location" id="UserPlan" class="form-select mb-md-0 mb-2">
                                            <option value="">All Locations </option>
                                            <option v-for='locations1 in locations' :value='locations1.location_name'>{{ locations1.location_name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 user_status">
                                        <label class="form-label" for="FilterTransaction">Department</label>
                                        <select id="FilterTransaction" v-model="department" class="form-select  mb-md-0 mb-2xx">
                                            <option value="">All Departments </option>
                                            <option v-for='departments1 in departments' :value='departments1.department_name'>{{ departments1.department_name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 user_status">
                                        <button @click="getbyfilter()" style="margin-top:20px;background:#c1c1c1;width:100%;height: 40px !important;margin-bottom:20px;width: 60% !important;" class="btn btn-common">Search</button>
                                        <label style="color: #d93025" v-if="designation=='' && location=='' && department==''">{{e_search}}</label>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-bottom:20px;" class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-12 ps-xl-75 ps-0">
                                    <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="me-1">
                                            <div class="dataTables_filter" style="margin-top:5px">
                                                <label>
                                                    <input autocomplete="off" id="keyword1" type="text" name="keyword1" v-model="keyword1" class="form-control" style="" placeholder="Search By Name" />
                                                </label>
                                            </div>
                                        </div>
                                        <div class="dt-buttons d-inline-flex mt-50">
                                            <router-link to="/hr/create_warning" class="dt-button add-new btn btn-primary" tabindex="0" type="button"><span>Issue Warning Letter</span></router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" style="overflow-x: initial !important;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; vertical-align:middle !important;">Date</th>
                                            <th style="text-align:center; vertical-align:middle !important;">Name & Designation</th>
                                            <th style="text-align:center; vertical-align:middle !important;">Employee<br />Code</th>
                                            <th style="text-align:center; vertical-align:middle !important;">Department</th>
                                            <th style="text-align:center; vertical-align:middle !important;">Location</th>
                                            <th style="text-align:center; vertical-align:middle !important;">Status</th>
                                            <th style="text-align:center; vertical-align:middle !important;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd" v-for="adsdata1 in adsdata.data">
                                            <td class=" control" tabindex="0" style="display: none;"></td>
                                            <td style="text-align: center; vertical-align: middle !important;">{{adsdata1.DateIssued}}</td>
                                            <td style="vertical-align: middle !important;" class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="d-flex flex-column"><a class="user_name text-truncate text-body"><span class="fw-bolder">{{adsdata1.EmployeeName}}</span></a><small class="emp_post text-muted">{{adsdata1.Designation}}</small></div>
                                                </div>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle !important;">{{adsdata1.EmployeeID}}</td>
                                            <td style="text-align: center; vertical-align: middle !important;">{{adsdata1.Department}}</td>
                                            <td style="text-align: center; vertical-align: middle !important;"><span class="text-truncate align-middle">{{adsdata1.Location}}</span></td>
                                            <td style="text-align: center; vertical-align: middle !important;">
                                                <span v-if="adsdata1.WarningType=='First'" class="badge bg-light-primary">{{adsdata1.WarningType}}</span>
                                                <span v-else-if="adsdata1.WarningType=='Second'" class="badge bg-light-primary">{{adsdata1.WarningType}}</span>
                                                <span v-else class="badge bg-light-danger">{{adsdata1.WarningType}}</span>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle !important;">
                                                <div class="btn-group">
                                                    <router-link :to="{ name: 'warning_view', params: { id: adsdata1.LetterID }}" class="me-25">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </router-link>
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
    </div>
</template>
<script>
export default {
    data() {
        return {
        user_access:{},
            adsdata: {

            },
            success: '',

            keyword1: '',

            department: '',
            location: '',
            designation: '',
            designations: {},
            departments: {},
            locations: {},
            id: '',

            e_search: '',

            email: '',
            count_users: {},
        }
    },
    methods: {
        getbyfilter() {
            axios.post('./filter_warnings', {
                    location: this.location,
                    designation: this.designation,
                    department: this.department,


                })
                .then(data => {
                    this.adsdata = data.data;

                })



        },

        getResult(page = 1) {

            axios.get('warning_detail/?page=' + page)
                .then(response => this.adsdata = response.data)
                .catch(error => {});
        },
        getResults() {
            axios.get('./search_warnings', { params: { keyword1: this.keyword1 } })
                .then(response => this.adsdata = response.data)
                .catch(error => console.log(error));
        },
    },
    watch: {
        keyword1(after, before) {
            this.getResults();
        }
    },
    mounted() {
        axios.get('department_detail2')
            .then(data => this.departments = data.data)
        axios.get('overall_designation')
            .then(response => this.designations = response.data)
            .catch(error => {});
        axios.get('overall_location')
            .then(response => this.locations = response.data)
            .catch(error => {});
        axios.get('./count_warnings')
            .then(response => this.count_users = response.data)
            .catch(error => {});
            axios.get('./fetch_user_hr_roles')
.then(response => this.user_access = response.data)
        this.getResult();
    }
}

</script>

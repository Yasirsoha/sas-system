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
                                <router-link to="/" style="text-decoration: none;">Employee Dashboard</router-link>
                            </li>
                            <li class="breadcrumb-item">
                                Team attendance
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="content-body">
                    <!-- users list start -->
                    <section class="app-user-list">
                        <div clas="card" style="background-color:white !important">
                            <div class="card-body border-bottom">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5 class="card-title" style="margin-top:2%">Search Team member's name:</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" @change="search_candidate()" v-model="emp_name" class="form-control" placeholder="Name" />
                                        <span style="color: #DB4437; font-size: 11px;" v-if="this.emp_name==''">{{emp_name_error}}</span>
                                    </div>
                                    <div class="col-md-3">
                                        <button @click="getbyfilter()" style="background:#c1c1c1; height: 65% !important; margin-bottom:20px; width: 40% !important;" class="btn btn-common">Search</button>
                                    </div>
                                        <div class="col-md-3">
                                            <div class="card-header">
                                            </div>
                                        </div>
                                        <div class="col-md-3 user_status">
                                        </div>
                                    </div>
                                </div>
                            <div class="table-responsive" style="overflow-x: initial !important;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">Status</th>
                                            <th style="text-align:center;">Employee Id</th>
                                            <th>Name</th>
                                            <th style="text-align:center;">View attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="team1 in team">
                                            <td style="text-align:center;">{{team1.Status}}</td>
                                            <td style="text-align:center;">{{team1.EmployeeID}}</td>
                                            <td>{{team1.Name}}</td>
                                            <td style="text-align:center;">
                                                <router-link :to="{name: 'int_att', params:{id: team1.EmployeeID}}" style="text-decoration: none;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                    </svg>
                                                </router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                team: {},
                date: '',
                cin: '',
                cout: '',
                cId: '',
                id1:'',
                attendance:'',
                designations:'',
                emp_name: '',
                emp_name_error: '',

                att_sts:'',
            }
        },
        methods: {
            getbyfilter() {
                if (this.emp_name == '') {
                    this.emp_name_error = "Enter name";
                    this.$toastr.e("Please enter employee name", "Important Fields Missing!")

                    axios.get('ind_team_att')  //Get all team of logged in employee
                        .then(data => this.team = data.data)
                        .catch(error => { });
                }
                else {

                    axios.post('./search_member', {
                        srch_name: this.emp_name,
                    })
                        .then(data => {
                            this.team = data.data;
                            this.$toastr.s("Search result fetched Successfully", "Congratulations!");

                    })
                        .catch(error => this.error = error.response.data.errors)
                }
            },
            fetch_id(id) {
                this.id1 = id;
            }
        },
        mounted() {
            axios.get('ind_team_att')  //Get all team of logged in employee
                .then(data => this.team = data.data)
                .catch(error => { });
        }
    }
</script>

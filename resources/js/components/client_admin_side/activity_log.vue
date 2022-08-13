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
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <router-link class="d-flex align-items-center" to="/">
                                        Dashboard
                                    </router-link>
                                </li>
                                <li class="breadcrumb-item active">
                                    Activity log
                                </li>
                            </ol>
                        </div>
                        <div clas="card" style="background-color:white !important">
                            <div class="card-body border-bottom">
                                <h4 class="card-title">Search & Filter</h4>
                                <div class="row">
                                    <div class="col-md-3 ">
                                        <label class="form-label" for="fromDate">From Date</label>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label class="form-label" for="toDate">To Date</label>
                                    </div>
                                    <div class="col-md-3 user_status">
                                        <label class="form-label" for="FilterTransaction">Users</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 ">
                                        <input type="date" class="form-control account-number-mask" v-model="fromDate">
                                        <span style="color: #d93025" v-if="fromDate==''">{{e_fromDate}}</span>
                                    </div>
                                    <div class="col-md-3 ">
                                        <input type="date" class="form-control account-number-mask" v-model="toDate">
                                        <span style="color: #d93025" v-if="toDate==''">{{e_toDate}}</span>
                                    </div>
                                    <div class="col-md-3 user_status">
                                        <select v-model="users" class="form-select  mb-md-0 mb-2xx">
                                            <option value="">Select User Id</option>
                                          <option v-for='user_detail1 in user_detail' :key="user_detail1" :value='user_detail1.email'>{{ user_detail1.first_name}} {{ user_detail1.last_name}} ( {{ user_detail1.email}})</option>
                                        </select>
                                        <span style="color: #d93025" v-if="users==''">{{e_users}}</span>
                                    </div>
                                    <div class="col-md-1" style="text-align:center">
                                        <button type="button" @click="getResult()" class="btn btn-primary mt-1 me-1 waves-effect waves-float waves-light">Search</button>

                                    </div>
                                    <div class="col-md-2">
                                    <div class="dt-buttons d-inline-flex mt-50">
                                            <button type="button" class="btn btn-gradient-info"> Excel</button>
                                            <button style="margin-left: 20px" type="button" class="btn btn-gradient-info"> Pdf</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-bottom:20px;" class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-12 ps-xl-75 ps-0">
                                    <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="me-1">
                                            <div class="dataTables_filter" style="margin-top:5px"></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" style="overflow-x: initial !important;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>DateTime</th>
                                           
                                            <th>User Id</th>
                                             <th>Activity Type</th>
                                            <th>Activity Detail</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="adsdata1 in adsdata" :key="adsdata1">
                                            <td>
                                               {{adsdata1.ActivityTime}} 
                                            </td>
                                           
                                            <td>
                                              {{adsdata1.UserEmail}}
                                            </td>
                                            <td>
                                               {{adsdata1.EventStatus}} 
                                            </td>
                                            <td>
                                               {{adsdata1.Description}} 
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
                adsdata: {

                },
                fromDate: '',
                toDate: '',
                users: '',
                user_detail:{

                },
                e_fromDate: '',
                e_toDate: '',
                e_users: '',
            }
        },
        methods: {
            getResult() {
                if (this.fromDate == '' || this.toDate == '' || this.users == '') {
                    if (this.fromDate == '') {
                        this.e_fromDate = 'Select date!'
                    }
                    else {
                        this.e_fromDate = ''
                    }
                    if (this.toDate == '') {
                        this.e_toDate = 'Select date!'
                    }
                    else {
                        this.e_toDate = ''
                    }
                    if (this.users == '') {
                        this.e_users = 'Select user!'
                    }
                    else {
                        this.e_users = ''
                    }
                }
                else {
                    //Submit search form
                     axios.post('./filter_activity', {
                   users:this.users,
                   fromDate: this.fromDate,
                toDate: this.toDate,
                   
       
                    })
                    .then(data => {
                        this.adsdata=data.data;
                        
                    })


                }
            }
        },
       
        mounted() {
         axios.get('overall_users')
                .then(response => this.user_detail = response.data)
        }
    }
</script>

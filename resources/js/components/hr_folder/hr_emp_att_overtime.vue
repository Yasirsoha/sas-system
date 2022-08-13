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
                            <li class="breadcrumb-item active">Attendance Details
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-primary" style="padding-top:0px;padding-bottom:0px" role="alert">
                            <div class="alert-body">
                            <ul class="nav nav-pills mb-2" style="width:90%;float:left">
                                <li class="nav-item">
                                    <router-link to="/hr/attendance/dashboard"  class="nav-link " >
                                        <i class="fa-solid fa-person"></i>
                                        <span class="fw-bold">Live Attendance</span></router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/hr/attendance_emp" class="nav-link " >
                                       <i class="fa-solid fa-candy-cane"></i>
                                        <span class="fw-bold">Employees Attendance</span>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/hr/employee_overtime" class="nav-link active" >
                                      <i class="fa-solid fa-file-powerpoint"></i>
                                        <span class="fw-bold">Employees Overtime</span>
                                    </router-link>
                                </li>

                               </ul>
                               <div>
                               <b-dropdown id="dropdown-right" right text="Actions" variant="primary" class="m-2" style="background-color: #0d6efd;">
							     <b-dropdown-item :to="{ path: '/hr/attendance_grace_periods' }"> Grace Period(s) </b-dropdown-item>
<b-dropdown-item :to="{ path: '/hr/attendance_rosters' }"> Shift(s) </b-dropdown-item>

<b-dropdown-item>Shift Calendar</b-dropdown-item>
							  </b-dropdown>
							  </div>

                            </div>
                        </div>
                    </div>
                </div>
                    <section class="app-user-view-account">
                        <div class="row">
                            <!-- User Sidebar -->
                            <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                                <div class="card">
                                    
                                    <div class="card-body">
                                    
                                      <div class="table-responsive" style="overflow-x: initial !important;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                             <th>Department</th>
                                            <th>Location</th>
                                           <th>Check In</th>
                                            <th>Check Out</th>
                                              <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd" v-for="adsdata1 in adsdata.data">
                                            
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="d-flex flex-column"><a class="user_name text-truncate text-body"><span class="fw-bolder">{{adsdata1.first_name}} {{adsdata1.last_name}}</span></a><small class="emp_post text-muted">{{adsdata1.user_role}}({{adsdata1.emp_code}} )</small></div>
                                                </div>
                                            </td>
                                           
                                              <td class=" control" tabindex="0" ></td>
                                            <td></td>
                                            <td>{{adsdata1.ofc_location}}</td>
                                            <td><span class="text-truncate align-middle"></span></td>
                                            <td>

                                           <span  class="badge bg-light-success">15 Min Early</span>
                                                </td>

                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="text-align:center;padding-top:20px">
                                <pagination :data="adsdata" @pagination-change-page="getResult"></pagination>
                            </div>

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

  data: function() {
        return {
          user_access:{},
            adsdata: {

            },
            
}
         },
      
 methods: {
    
        getResult(page = 1) {

            axios.get('users_detail/?page=' + page)
                .then(response => this.adsdata = response.data)
                .catch(error => {});
        },
        
       
    },

    mounted() {
  this.getResult();
  axios.get('./fetch_user_hr_roles')
                .then(response => this.user_access = response.data)
    }
}

</script>

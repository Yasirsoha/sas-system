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
        <router-link to="/hr/attendance/dashboard"  class="nav-link active" >
            <i class="fa-solid fa-person"></i>
            <span class="fw-bold">Live Attendance</span></router-link>
    </li>
    <li class="nav-item">
        <router-link to="/hr/attendance_emp" class="nav-link" >
           <i class="fa-solid fa-candy-cane"></i>
            <span class="fw-bold">Employees Attendance</span>
        </router-link>
    </li>
    <li class="nav-item">
        <router-link to="/hr/employee_overtime" class="nav-link" >
          <i class="fa-solid fa-file-powerpoint"></i>
            <span class="fw-bold">Employees Overtime</span>
        </router-link>
    </li>

   </ul>
   <div>
   <b-dropdown id="dropdown-right" right text="Actions" style="background-color: #0d6efd;"  class="m-2" >
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
<div class="col-xl-9 col-lg-9 col-md-9 order-1 order-md-0">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Today's Attendance Summary</h4>
             <a href="#" type="button" class="btn btn-outline-primary waves-effect">Pull Attendance</a>
        </div>
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
            <tr class="odd" v-for="adsdata1 in adsdata.data" :key="adsdata1">
                
                <td class="sorting_1">
                    <div class="d-flex justify-content-left align-items-center">
                        <div class="d-flex flex-column"><a class="user_name text-truncate text-body"><span class="fw-bolder">{{adsdata1.Name}} </span></a><small class="emp_post text-muted">{{adsdata1.Designation}}({{adsdata1.EmployeeCode}} )</small></div>
                    </div>
                </td>
               
                  <td class=" control" tabindex="0" >{{adsdata1.Department}}</td>
                
                <td>{{adsdata1.PostingCity}}</td>
               <td v-if="adsdata1.CheckIN !=null">{{adsdata1.CheckIN.substring(0,5)}}</td>
<td v-else></td>
<td v-if="adsdata1.CheckOut !=null">{{adsdata1.CheckOut.substring(0,5)}}</td>
<td v-else></td>
                <td>
        <span v-if="adsdata1.AttStatus=='P'"  class="badge bg-light-success">Present</span>
         <span v-else-if="adsdata1.AttStatus=='L'"  class="badge bg-light-primary">Late</span>
          <span v-else-if="adsdata1.AttStatus=='A'"  class="badge bg-light-danger">Absent</span>
          <span v-else-if="adsdata1.AttStatus=='H'"  class="badge bg-light-info">Holiday</span>

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
<div class="col-xl-3 col-lg-3 col-md-3 order-1 order-md-0">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Current Session Leaves</h4>
        </div>
        <div class="card-body">
         <apexchart  type="pie" :options="options" :series="series"></apexchart>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Active Employees</h4>
        </div>
        <div class="card-body">
        <label class="form-label">Present Today</label>
         <b-progress  animated show-progress :max="max" class="mb-3">
<b-progress-bar variant="success" :value="present"></b-progress-bar>
</b-progress>

<label class="form-label">Late Today</label>
         <b-progress  animated show-progress :max="max" class="mb-3">
<b-progress-bar variant="primary" :value="late"></b-progress-bar>
</b-progress>
<label class="form-label">Absent Today</label>
         <b-progress  animated show-progress :max="max" class="mb-3">
<b-progress-bar variant="danger" :value="absent"></b-progress-bar>
</b-progress>
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
import VueApexCharts from 'vue-apexcharts'	
export default {
components: {
apexchart: VueApexCharts,
},
data: function() {
return {
 user_access:{},
present:'',
absent:'',
late:'',
max:'',
adsdata: {

},
se0:'',
se1:'',
se2:'',
series: [10,20,30],
options: {
chart: {
id: 'vuechart-example',
height: 150,
},
labels: ['Sick', 'Casual', 'Annual'],
responsive: [{
breakpoint: 480,
options: {
chart: {
width: 200
},
legend: {
position: 'bottom'
}
}
}],


},


}
},

methods: {

getResult(page = 1) {

axios.get('attendance_detail/?page=' + page)
.then(response => this.adsdata = response.data)
.catch(error => {});
},


},

mounted() {
axios.get('./fetch_user_hr_roles')
                .then(response => this.user_access = response.data)

axios.get('./get_count_leave')
.then(response => {
  this.series=response.data;
 

  })
this.getResult();
axios.get('./count_today_attendance')
.then(response => {
  this.max=response.data.max;
  this.present=response.data.pres;
  this.absent=response.data.abse;
  this.late=response.data.late;
  })
.catch(error => {});

}
}

</script>

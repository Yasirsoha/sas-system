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
                    <router-link to="/hr/dashboard" style="text-decoration: none;">Accounts Dashboard</router-link>
                </li>
                <li class="breadcrumb-item active">Product Categories
                </li>
            </ol>
        </div>
    </div>
    <div class="content-body">
        <section class="app-user-view-account">
            <div class="row">
                <!-- User Sidebar -->
                 <div class="col-xl-5 col-lg-5 col-md-5 order-1 col-12 order-md-0">
                    <!-- User Card -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Category</h4>
                            
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom:20px;" class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <section id="accordion-with-border">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="accordionWrapa50" role="tablist" aria-multiselectable="true">
                                                <div class="card">
                                                   
                                                    <div class="card-body">
                                                         <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                <div class="col-12">
                    <label class="form-label" for="modalAddCardName">Product Name</label>
                    <input autocomplete="off" v-model="category_name" class="form-control" style="" placeholder="Type Product Name Here" />
                    <span
                              style="color: #db4437; font-size: 11px"
                              v-if="category_name == ''"
                              >{{ category_name_error }}</span
                            >
                </div>
                <div class="col-12">
                    <label class="form-label" for="modalAddCardName">Description</label>
                   <textarea class="form-control" v-model="category_description" placeholder="Type Product Description Here"></textarea>
                <span
                              style="color: #db4437; font-size: 11px"
                              v-if="category_description == ''"
                              >{{ category_description_error }}</span
                            >
                </div>
                <div>
                    <label style="width:100%">Status</label>
                    <div style="margin-bottom:10px" class="form-check form-check-info form-switch">
                        <input style="width: 50px;" type="checkbox" v-model="category_status" class="form-check-input" id="customSwitch3">
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" @click="submit_cateogory()" class="btn btn-primary me-1 mt-1" data-bs-dismiss="modal" aria-label="Close">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                </div>
            </form>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <!-- /User Card -->
                </div>
                <!--/ User Sidebar -->
                 <div class="col-xl-7 col-lg-7 col-md-7 order-1 col-12 order-md-0">
                    <!-- User Card -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Categories Detail</h4>
                            <div style="text-align: right;">
                               
                                <div class="" style="float:right">
                                    <div style=""><label>
                                            <input autocomplete="off" class="form-control" style="" placeholder="Search By Name" />
                                        </label></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom:20px;" class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <section id="accordion-with-border">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="accordionWrapa50" role="tablist" aria-multiselectable="true">
                                                <div class="card">
                                                   
                                                    <div class="card-body">
                                                        <div class="table-responsive" style="overflow-x: initial !important;">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Description</th>
                                                                       <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                   <tr>
                                                                   <td>Furniture</td>
                                                                   <td>Furniture Detail Furniture Detail Furniture Detail </td>
                                                                  

                                                                   <td>
                                                                   <div style="margin-bottom:10px" class="form-check form-check-info form-switch">
                                                                    <input style="width: 50px;" type="checkbox"  class="form-check-input" id="customSwitch3">
                                                                    </div>

                                                                   </td>
                                                                   <td>
                                                                    <div class="dropdown chart-dropdown">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-medium-3 cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                                                        <a class="dropdown-item" >Edit</a>
                                                                    </div>
                                                                </div>
                                                                   </td>
                                                                   </tr>
                                                                   <tr>
                                                                   <td>Furniture

                                                                   </td>
                                                                   <td>Furniture Detail Furniture Detail Furniture Detail </td>
                                                                  
                                                                   
                                                                   <td>
                                                                   <div style="margin-bottom:10px" class="form-check form-check-info form-switch">
                                                                    <input style="width: 50px;" type="checkbox"  class="form-check-input" id="customSwitch3">
                                                                </div>

                                                                   </td>
                                                                   <td>
                                                                    <div class="dropdown chart-dropdown">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-medium-3 cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                                                        <a class="dropdown-item" >Edit</a>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <!-- /User Card -->
                </div>
            </div>
        </section>
    </div>
</div>
</div>

</div>
</template>
<script>
export default {
data() {
return {
user_access: {},
category_name: '',
category_description: '',
category_name_error:"",
category_description_error:"",
category_status: 'true',
adsdata: {

},

}
},

methods: {
fetch_session_id(id) {
this.fetch_sessoin_id = id;
},
update_session_payroll() {
axios.get('update_payroll_status/' + this.fetch_sessoin_id)
    .then(response => {

        this.$toastr.s("Attendance Closed and proceed in Payroll Section!", "Information");

    })
this.$router.go(0);
},





delete_session(id) {
axios.get('delete_session/' + id)
    .then(response => {
        this.$toastr.s("Delete Record Successfully!", "Deleted");
        this.adsdata = response.data

    })
    .catch(error => {});

},

submit_cateogory() {
    if (
        this.category_name == "" ||
        this.category_description == ""
      ) {
        this.$toastr.e("Please fill required fields!", "Caution!");
        if (this.category_name == "") {
          this.category_name_error = "Please enter category name";
        }
        if (this.category_description == "") {
          this.category_description_error = "Please enter description";
        }
        
      }
if(this.category_name && this.category_description){
    

axios.post('submit_session', {
        session_start: this.session_start,
        session_end: this.session_end,
        c_session: this.c_session,
    })
    .then(data => {
        if (data.data == 'NotSubmitted') {
            this.$toastr.e("Session Name Already Exists!", "Change Roster Name");
        } else {
            this.$toastr.s("Session Created Successfully!", "Congratulations");
            this.adsdata = data.data;
        }


    })
    .catch(error => {});

}

},
getResult(page = 1) {

axios.get('session_detail/?page=' + page)
    .then(response => this.adsdata = response.data)
    .catch(error => {});
},


},

mounted() {
axios.get('./fetch_user_hr_roles')
.then(response => this.user_access = response.data)
this.getResult();
this.getResult2();
this.getResult3();
this.getResult4();
axios.get('view_hr_configuration')
.then(response => {
    this.gratuty_start = response.data[0].GratutyStart;
    this.max_loan = response.data[0].MaxLoan;
    this.days_deduction = response.data[0].MinutesDeduction;
    this.max_installment = response.data[0].MaxInstallment;
    this.annual_leaves = response.data[0].AnnualLeaves;
    this.sick_leaves = response.data[0].SickLeaves;
    this.casual_start = response.data[0].CasualLeaves;

})
.catch(error => {});
axios.get('find_emp_id')
.then(data => this.find_emp = data.data)
.catch(error => {});
}
}

</script>

<style>

</style>

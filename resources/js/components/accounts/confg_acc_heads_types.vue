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
            <li class="breadcrumb-item active">Accounts Heads/ Types
            </li>
        </ol>
    </div>
</div>
<div class="content-body">
    <section class="app-user-view-account">
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-6 col-lg-6 col-md-6 order-1 col-12 order-md-0">
                <!-- User Card -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Accounts Category</h4>
                        <div style="text-align: right;width: 60% !important;">
                            <a style="float:left" data-bs-toggle="modal" data-bs-target="#addNewCard" class="btn btn-outline-primary waves-effect" type="button">Create New</a>
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
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Furniture</td>
                                                                    <td>Furniture Detail Furniture Detail Furniture Detail </td>
                                                                    <td>
                                                                        <div style="margin-bottom:10px" class="form-check form-check-info form-switch">
                                                                            <input style="width: 50px;" type="checkbox" class="form-check-input" id="customSwitch3">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Furniture
                                                                    </td>
                                                                    <td>Furniture Detail Furniture Detail Furniture Detail </td>
                                                                    <td>
                                                                        <div style="margin-bottom:10px" class="form-check form-check-info form-switch">
                                                                            <input style="width: 50px;" type="checkbox" class="form-check-input" id="customSwitch3">
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
            <!--/ User Sidebar -->
            <div class="col-xl-6 col-lg-6 col-md-6 order-1 col-12 order-md-0">
                <!-- User Card -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Journal Heads</h4>
                        <div style="text-align: right;width: 60% !important;">
                            <a style="float:left" data-bs-toggle="modal" data-bs-target="#addNewCard2" class="btn btn-outline-primary waves-effect" type="button">Create New</a>
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
                                                                    <th>Code</th>
                                                                    <th>Name</th>
                                                                    <th>Description</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>123</td>
                                                                    <td>Furniture</td>
                                                                    <td>Furniture Detail Furniture Detail Furniture Detail </td>
                                                                    <td>
                                                                        <div style="margin-bottom:10px" class="form-check form-check-info form-switch">
                                                                            <input style="width: 50px;" type="checkbox" class="form-check-input" id="customSwitch3">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>124</td>
                                                                    <td>Furniture
                                                                    </td>
                                                                    <td>Furniture Detail Furniture Detail Furniture Detail </td>
                                                                    <td>
                                                                        <div style="margin-bottom:10px" class="form-check form-check-info form-switch">
                                                                            <input style="width: 50px;" type="checkbox" class="form-check-input" id="customSwitch3">
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
<div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
    <div class="modal-header bg-transparent">
        <h3 class="text-center mb-1" id="addNewCardTitle">Create Accounts Category</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body px-sm-5 mx-50 pb-5">
        <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
            <div class="col-12">
                <label class="form-label" for="modalAddCardName">Category Name</label>
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

            <div class="col-12 text-center">
                <button type="submit" @click="submit_cateogory()" class="btn btn-primary me-1 mt-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="addNewCard2" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
    <div class="modal-header bg-transparent">
        <h3 class="text-center mb-1" id="addNewCardTitle">Create Journal Head</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body px-sm-5 mx-50 pb-5">
        <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
            <div class="col-12">
                <label class="form-label" for="modalAddCardName">Journal Name</label>
                <input autocomplete="off" v-model="journal_name" class="form-control" style="" placeholder="Type Journal Name Here" />
                <span
                              style="color: #db4437; font-size: 11px"
                              v-if="journal_name == ''"
                              >{{ journal_name_error }}</span
                            >
            </div>
            <div class="col-12">
                <label class="form-label" for="modalAddCardName">Journal Code</label>
                <masked-input class="form-control account-number-mask" v-model="journal_code" mask="111" placeholder="Journal Code Here" />
               <span
                              style="color: #db4437; font-size: 11px"
                              v-if="journal_code == ''"
                              >{{ journal_code_error }}</span
                            >
            </div>
            <div class="col-12">
                <label class="form-label" for="modalAddCardName">Type</label>
                <select v-model="type" class="form-select">
                <option value="">Select Type</option>
                </select>
               <span
                              style="color: #db4437; font-size: 11px"
                              v-if="type == ''"
                              >{{ type_error }}</span
                            >
            </div>
            <div class="col-12">
                <label class="form-label" for="modalAddCardName">Description</label>
                <textarea class="form-control" v-model="description" placeholder="Type Product Description Here"></textarea>
            <span
                              style="color: #db4437; font-size: 11px"
                              v-if="description == ''"
                              >{{ description_error }}</span
                            >
            </div>
             <div class="col-12">
             <div style="margin-bottom:10px" class="form-check form-check-info form-switch">
                            <input style="width: 50px;" type="checkbox" class="form-check-input" id="customSwitch3">
            </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" @click="submit_heads()" class="btn btn-primary me-1 mt-1">Submit</button>
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
</template>
<script>
import MaskedInput from 'vue-masked-input'
export default {
data() {
return {
user_access: {},
journal_name:"",
journal_name_error:"",
journal_code:"",
journal_code_error:"",
type:"",
type_error:"",
description:"",
description_error:"",
category_name: '',
category_description: '',
category_name_error:"",
category_description_error:"",
category_status: 'true',
adsdata: {

},

}
},
components: {
MaskedInput
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

submit_heads() {
 if (
        this.journal_name == "" ||
        this.description == "" ||
        this.journal_code=="" ||
        this.description==""
      ) {
        this.$toastr.e("Please fill required fields!", "Caution!");
        if (this.journal_name == "") {
          this.journal_name = "Please enter journal name";
        }
        if (this.journal_code == "") {
          this.journal_code_error = "Please enter journal code";
        }
        if (this.type == "") {
          this.type_error = "Please select type";
        }
        if (this.description == "") {
          this.description_error = "Please enter description";
        }
        
      }
if(this.journal_name && this.journal_code && this.type && this.description){
    

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


axios.get('find_emp_id')
.then(data => this.find_emp = data.data)
.catch(error => {});
}
}

</script>
<style>
</style>
